<template>
  <div class="">
    <swiper ref="slider" :options="swiperOptions">
      <slot name="items"></slot>
      <div class="slider__pagination" slot="pagination" v-if="pagination"></div>
    </swiper>

    <div :class="prevClass" slot="button-prev" v-if="navigation"><</div>
    <div :class="nextClass" slot="button-next" v-if="navigation">></div>
  </div>
</template>

<script>
  export default {
    name: 'slider',
    data() {
      return {
        prevClass: `slider__navigation slider__navigation--prev slider__navigation--prev--${this._uid}`,
        nextClass: `slider__navigation slider__navigation--next slider__navigation--next--${this._uid}`,
        swiperOptions: {
          navigation: this.navigation
            ? {
              nextEl: `.slider__navigation--next--${this._uid}`,
              prevEl: `.slider__navigation--prev--${this._uid}`
            }
            : false,
          pagination: (this.pagination)
            ? {
              el: '.slider__pagination',
              clickable: true
            }
            : false,
          spaceBetween: 18,
          slidesPerView: 1,

          autoplay: this.autoLoop
            ? {
              delay: 4000,
              disableOnInteraction: false
            }
            : false,

          speed: 1250,
          loop: this.loop,
          touchRatio: 1 < this.swipeCount ? true : false,
          grabCursor: 1 < this.swipeCount ? true : false,

          // Responsive breakpoints
          breakpoints: {
            // when window width is >= 768px
            768: {
              slidesPerView: 2 < this.slidesPerView ? 2 : this.slidesPerView,

              touchRatio: this.swipeCount <= this.slidesPerView ? false : true,
              grabCursor: this.swipeCount <= this.slidesPerView ? false : true
            },
            // when window width is >= 992px
            1200: {
              slidesPerView: this.slidesPerView
            }
          }
        }
      };
    },
    props: {
      slidesPerView: {
        default: 1
      },
      navigation: {
        default: false
      },
      pagination: {
        default: false
      },
      autoLoop: {
        default: false
      },
      swipeCount: {
        default: 0
      },
      loop: {
        default: true
      }
    },
    computed: {
      swiper() {
        return this.$refs.slider.$swiper;
      }
    }
  };
</script>
