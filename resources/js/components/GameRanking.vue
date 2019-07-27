<template>
  <div class="game-ranking">
    <a id="ranking" name="ranking" rel="external nofollow">&nbsp;</a>
    <h2 class="game-ranking-title">奖牌排名</h2>
    <hr class="game-ranking-hr">
    <div class="game-ranking-table-container">
      <table class="game-ranking-table">
        <tr class="game-ranking-first-line">
          <th>排名</th>
          <th>队伍名称</th>
          <th>奖牌数</th>
        </tr>
        <tr v-for="(item, i) in rankedTeamsRankedMedal" :key="i">
          <td>{{ item.rank }}</td>
          <td>{{ item.name }}</td>
          <td>{{ item.total_count }}</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'GameRanking',
  computed: {
    ...mapGetters({
      rankedTeamsRankedMedal: 'rankedTeamsRankedMedal'
    })
  }
}
</script>

<style>
.game-ranking {
  padding: 60px 0;
  text-align: center;
}
.game-ranking-title {
  margin: 12px 0;
}
.game-ranking-hr {
  margin: 0 auto;
  max-width: 320px;
  border: none;
  border-bottom: 2px solid #000;
}
.game-ranking-table {
  margin: 0 auto;
  width: 100%;
  max-width: 300px;
}
.game-ranking-first-line th {
  padding-top: 12px;
}
@media screen and (min-width: 480px) {
  .game-ranking-hr {
    max-width: 400px;
  }
  .game-ranking-table {
    max-width: 380px;
  }
}
@media screen and (min-width: 640px) {
  .game-ranking-hr {
    max-width: 580px;
  }
  .game-ranking-table {
    max-width: 560px;
  }
}
@media screen and (min-width: 960px) {
  .game-ranking-hr {
    max-width: 800px;
  }
  .game-ranking-table {
    max-width: 780px;
  }
}
</style>
