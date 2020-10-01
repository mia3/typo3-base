<template>
  <div :class="{'is--playing':isPlaying, 'player--ready': videoReady}" class="base-video">
    <div class="play-action" v-on:click="play">
      <svg height="197px" version="1.1" viewBox="0 0 197 197" width="197px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g id="play" transform="translate(8.000000, 9.000000)">
          <path id="Oval" d="M90.5,181 C115.658154,181 138.418646,170.73439 154.821172,154.163476 C171.005587,137.812912 181,115.323616 181,90.5 C181,66.0870548 171.333538,43.9318328 155.619315,27.6530363 C139.161072,10.6034877 116.068825,0 90.5,0 C66.0090706,0 43.7903114,9.7283176 27.4972142,25.5314612 C10.5389056,41.9798125 0,65.0091596 0,90.5 C0,117.003056 11.3925024,140.845251 29.5475157,157.396593 C45.6308061,172.059212 67.0212866,181 90.5,181 Z" fill="#transparent" stroke="#FFFFFF" stroke-width="15"></path>
          <polygon id="Triangle" fill="#FFFFFF" points="98.187251 63.6553785 114.919662 93.0750017 130.998008 121.344622 98.6633838 121.344622 65.376494 121.344622 81.7362109 92.5802842" transform="translate(98.187251, 92.500000) scale(-1, 1) rotate(-90.000000) translate(-98.187251, -92.500000) "></polygon>
        </g>
      </svg>
    </div>
    <div class="backdrop"></div>
    <div class="player">
      <div :class="'media ' + aspectRatioClass">
        <video ref="video"
               v-bind="attributes"
               v-on:canplay="videoReady = true"
               v-on:pause="isPlaying = false"
        >
          <slot></slot>
        </video>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'base-video',
    data () {
      return {
        isPlaying: false,
        videoReady: false,
      };
    },
    props: {
      aspectRatioClass: {
        type: String,
        default: 'media--default',
      },
    },
    methods: {
      logEvt (evt) {
        console.log(evt);
      },
      play () {
        this.$refs.video.play();
        this.isPlaying = true;
      },
      pause () {
        this.$refs.video.pause();
        this.isPlaying = false;
      },
    },
    computed: {
      attributes () {
        return {
          ...this.$attrs,
        };
      },
    },
  };
</script>
