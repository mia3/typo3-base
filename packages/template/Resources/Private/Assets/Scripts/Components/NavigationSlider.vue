<template>
  <div>
    <!-- Nav line I -->
    <ul class="navigation-slider__nav navigation-slider__nav--type-1">
      <li v-for="slide in type1" @click="slideTo(slide)">
        <span class="navigation-slider__nav-label">{{ slide.label }}</span>
      </li>
    </ul>

    <!-- Nav line II -->
    <ul class="navigation-slider__nav navigation-slider__nav--type-2">
      <li v-for="slide in type2" @click="slideTo(slide)">
        <img v-if="slide.icon" :src="slide.icon" class="navigation-slider__nav-icon">
        <span class="navigation-slider__nav-label">{{ slide.label }}</span>
      </li>
    </ul>

    <!-- Slides -->
    <swiper ref="mySwiper" :options="swiperOptions">
      <swiper-slide v-for="(slide, i) in allTypes" :key="i">
        <div :style="contentStyle(slide)" class="navigation-slider__content-wrapper">
          <div class="navigation-slider__content" v-html="slide.content"></div>
        </div>
      </swiper-slide>
    </swiper>
  </div>
</template>

<script>
  import { Swiper, SwiperSlide } from 'vue-awesome-swiper';

  export default {
    name: 'navigation-slider',
    props: ['slides'],
    components: {
      Swiper,
      SwiperSlide
    },
    data () {
      return {
        swiperOptions: {}
      };
    },
    computed: {
      allTypes () {
        return Object.values(this.slides);
      },
      type1 () {
        return this.allTypes.filter(s => s.type === 1);
      },
      type2 () {
        return this.allTypes.filter(s => s.type === 2);
      },
      swiper () {
        return this.$refs.mySwiper.$swiper;
      }
    },
    methods: {
      slideTo (slide) {
        this.swiper.slideTo(this.allTypes.findIndex(s => s === slide), 1000, false);
      },
      contentStyle (slide) {
        if (!slide.background) {
          return {};
        }

        return {
          background: `url('${slide.background}')`
        };
      }
    }
  };
</script>
