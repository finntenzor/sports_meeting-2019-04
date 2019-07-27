<template>
  <div class="gold-tops">
    <div class="gold-tops-header">金牌排名</div>
    <ul class="gold-tops-list">
      <li v-for="(item, i) in rankedTeamsRankedGolden" :key="i" class="gold-tops-item">
        <p class="gold-tops-item-line1">No.{{ item.rank }}：{{ item.total_count }}枚</p>
        <p class="gold-tops-item-line2">{{ item.name }}</p>
      </li>
    </ul>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'GoldTops',
  computed: {
    ...mapGetters({
      rankedTeamsRankedGolden: 'rankedTeamsRankedGolden'
    })
  }
}
</script>

<style>
.gold-tops {
  box-sizing: border-box;
  margin: 0 auto;
  max-width: 240px;
  background-color: #fff;
  border-radius: 12px;
  box-shadow: 2px 2px 12px #999;
  overflow: hidden;
  font-family: "Microsoft Yahei";
}
.gold-tops-header {
  padding: 8px 0;
  background-color: #3b55e6;
  color: #fff;
  text-align: center;
  font-size: 1.4em;
  font-weight: bold;
}
.gold-tops-list {
  padding: 8px 0;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.gold-tops-item {
  text-align: center;
  font-size: 1.2em;
}
.gold-tops-item-line1 {
  border-bottom: 1px solid #000;
}
.gold-tops-item-line1,
.gold-tops-item-line2 {
  padding: 6px;
}
@media screen and (min-width: 480px) {
  .gold-tops {
    display: flex;
    flex-direction: row-reverse;
    max-width: 400px;
  }
  .gold-tops-header {
    padding: 16px 8px;
    writing-mode: vertical-lr;
  }
  .gold-tops-list {
    padding: 20px 0;
    flex: 1 1 auto;
    flex-direction: row;
    justify-content: space-around;
  }
}
@media screen and (min-width: 640px) {
  .gold-tops {
    margin-top: -90px;
    height: 140px;
    max-width: 540px;
  }
}
</style>
