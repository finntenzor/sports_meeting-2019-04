<?php

namespace App\Http\Controllers\Api;

use App\Models\Game;
use App\Models\News;
use App\Models\Team;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function news()
    {
        $news = News::select('id', 'title')->orderBy('updated_at', 'desc')->get();

        return [
            'data' => array_values($news->toArray())
        ];
    }

    public function teams()
    {
        $teams_ranked_golden = Team::select('name')->withCount(['golden', 'golden_s'])->get()->sortByDesc(function ($team, $key) {
            return $team->golden_count + $team->golden_s_count;
        })->slice(0, 3);

        $teams_ranked_medal = Team::select('name')->withCount(['golden', 'golden_s', 'silver', 'silver_s', 'bronze', 'bronze_s'])->get()->sortByDesc(function ($team, $key) {
            return $team->golden_count + $team->golden_s_count + $team->silver_count + $team->silver_s_count + $team->bronze_count + $team->bronze_s_count;
        });

        $teams_ranked_golden_array = [];
        $teams_ranked_medal_array = [];

        foreach ($teams_ranked_golden as $team) {
            $teams_ranked_golden_array[] = [
                'name' => $team->name,
                'golden_count' => $team->golden_count,
                'golden_s_count' => $team->golden_s_count,
            ];
        }

        foreach ($teams_ranked_medal as $team) {
            $teams_ranked_medal_array[] = [
                'name' => $team->name,
                'golden_count' => $team->golden_count,
                'silver_count' => $team->silver_count,
                'bronze_count' => $team->bronze_count,
                'golden_s_count' => $team->golden_s_count,
                'silver_s_count' => $team->silver_s_count,
                'bronze_s_count' => $team->bronze_s_count,
            ];
        }

        return [
            'teams_ranked_golden' => ['data' => $teams_ranked_golden_array],
            'teams_ranked_medal' => ['data' => $teams_ranked_medal_array],
        ];
    }

    public function games()
    {
        $games_12am_track = Game::whereBetween('begins_at', ['2019-04-12 00:00:00', '2019-04-12 11:59:59'])->where('class', 1)->orderBy('begins_at', 'asc')->get();
        $games_12am_field = Game::whereBetween('begins_at', ['2019-04-12 00:00:00', '2019-04-12 11:59:59'])->where('class', 2)->orderBy('begins_at', 'asc')->get();
        $games_12pm_track = Game::whereBetween('begins_at', ['2019-04-12 12:00:00', '2019-04-12 23:59:59'])->where('class', 1)->orderBy('begins_at', 'asc')->get();
        $games_12pm_field = Game::whereBetween('begins_at', ['2019-04-12 12:00:00', '2019-04-12 23:59:59'])->where('class', 2)->orderBy('begins_at', 'asc')->get();
        $games_13am_track = Game::whereBetween('begins_at', ['2019-04-13 00:00:00', '2019-04-13 11:59:59'])->where('class', 1)->orderBy('begins_at', 'asc')->get();
        $games_13am_field = Game::whereBetween('begins_at', ['2019-04-13 00:00:00', '2019-04-13 11:59:59'])->where('class', 2)->orderBy('begins_at', 'asc')->get();
        $games_13pm_track = Game::whereBetween('begins_at', ['2019-04-13 12:00:00', '2019-04-13 23:59:59'])->where('class', 1)->orderBy('begins_at', 'asc')->get();
        $games_13pm_field = Game::whereBetween('begins_at', ['2019-04-13 12:00:00', '2019-04-13 23:59:59'])->where('class', 2)->orderBy('begins_at', 'asc')->get();

        $games_12am_track_array = [];
        $games_12am_field_array = [];
        $games_12pm_track_array = [];
        $games_12pm_field_array = [];
        $games_13am_track_array = [];
        $games_13am_field_array = [];
        $games_13pm_track_array = [];
        $games_13pm_field_array = [];

        foreach ($games_12am_track as $game) {
            $games_12am_track_array[] = $game->toArray();
        }

        foreach ($games_12am_field as $game) {
            $games_12am_field_array[] = $game->toArray();
        }

        foreach ($games_12pm_track as $game) {
            $games_12pm_track_array[] = $game->toArray();
        }

        foreach ($games_12pm_field as $game) {
            $games_12pm_field_array[] = $game->toArray();
        }

        foreach ($games_13am_track as $game) {
            $games_13am_track_array[] = $game->toArray();
        }

        foreach ($games_13am_field as $game) {
            $games_13am_field_array[] = $game->toArray();
        }

        foreach ($games_13pm_track as $game) {
            $games_13pm_track_array[] = $game->toArray();
        }

        foreach ($games_13pm_field as $game) {
            $games_13pm_field_array[] = $game->toArray();
        }

        return [
            'games_12am_track' => ['data' => $games_12am_track_array],
            'games_12am_field' => ['data' => $games_12am_field_array],
            'games_12pm_track' => ['data' => $games_12pm_track_array],
            'games_12pm_field' => ['data' => $games_12pm_field_array],
            'games_13am_track' => ['data' => $games_13am_track_array],
            'games_13am_field' => ['data' => $games_13am_field_array],
            'games_13pm_track' => ['data' => $games_13pm_track_array],
            'games_13pm_field' => ['data' => $games_13pm_field_array],
        ];
    }
}
