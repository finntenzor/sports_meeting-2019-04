import Vue from 'vue'
import Vuex from 'vuex'
import { fetchNews } from './api/data'
import { fetchTeams } from './api/data'
import { fetchGames } from './api/data'

Vue.use(Vuex)

function sumProperties (object, keys) {
  return keys.map(k => object[k]).reduce((a, b) => a + b)
}

function calcTotalAndRank (collection, keys) {
  const result = []
  for (let i = 0; i < collection.length; i++) {
    const item = collection[i]
    const total_count = sumProperties(item, keys)
    if (i === 0) {
      result.push({
        ...item,
        total_count,
        rank: i + 1
      })
    } else {
      const last = result[i - 1]
      const rank = total_count === last.total_count ? last.rank : i + 1
      result.push({
        ...item,
        total_count,
        rank
      })
    }
  }
  return result
}

export default new Vuex.Store({
  state: {
    initOver: false,
    news: {
      data: []
    },
    teams: {
      teams_ranked_golden: {
        data: []
      },
      teams_ranked_medal: {
        data: []
      }
    },
    games: {
      games_12am_track: {
        data: []
      },
      games_12am_field: {
        data: []
      },
      games_12pm_track: {
        data: []
      },
      games_12pm_field: {
        data: []
      },
      games_13am_track: {
        data: []
      },
      games_13am_field: {
        data: []
      },
      games_13pm_track: {
        data: []
      },
      games_13pm_field: {
        data: []
      },
    }
  },
  getters: {
    teamsRankedGolden: state => state.teams.teams_ranked_golden.data,
    teamsRankedMedal: state => state.teams.teams_ranked_medal.data,
    rankedTeamsRankedGolden: (_, getters) => calcTotalAndRank(getters.teamsRankedGolden, [
      'golden_count',
      'golden_s_count'
    ]),
    rankedTeamsRankedMedal: (_, getters) => calcTotalAndRank(getters.teamsRankedMedal, [
      'golden_count',
      'golden_s_count',
      'silver_count',
      'silver_s_count',
      'bronze_count',
      'bronze_s_count'
    ]),
    news: state => state.news.data,
    games_12am_track: state => state.games.games_12am_track.data,
    games_12am_field: state => state.games.games_12am_field.data,
    games_12pm_track: state => state.games.games_12pm_track.data,
    games_12pm_field: state => state.games.games_12pm_field.data,
    games_13am_track: state => state.games.games_13am_track.data,
    games_13am_field: state => state.games.games_13am_field.data,
    games_13pm_track: state => state.games.games_13pm_track.data,
    games_13pm_field: state => state.games.games_13pm_field.data,
  },
  mutations: {
    setInitOver (state, flag = true) {
      state.initOver = flag
    },

    setNews (state, payload) {
      state.news = payload
    },

    setTeams (state, teams) {
      state.teams = teams
    },

    setGames (state, games) {
      state.games = games
    }
  },
  actions: {
    async fetchData ({ commit }) {
      try {
        commit('setNews', await fetchNews())
        commit('setTeams', await fetchTeams())
        commit('setGames', await fetchGames())
        commit('setInitOver')
      } catch (error) {
        console.error(error)
        Vue.prototype.$toast.message.error(error.message)
      }
    }
  }
})
