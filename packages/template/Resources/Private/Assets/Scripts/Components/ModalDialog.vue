<template>
  <transition name="modal">
    <div :tabindex="1" @keydown.esc="closeModal" class="modal-dialog" ref="dialog" v-if="isOpen">
      <div class="backdrop" v-on:click="closeModal"></div>
      <div class="modal">
        <button :class="{'button-close--expanded': isOpen}" class="button button-close" v-on:click="closeModal">
          <span class="bar"></span>
          <span class="bar"></span>
        </button>
        <div class="modal-header">
          <slot name="title"></slot>
        </div>
        <div class="modal-content">
          <slot></slot>
        </div>
        <div class="modal-footer">
          <slot :cancelModal="cancelModal" :confirmModal="confirmModal" :openModal="openModal" name="footer"></slot>
        </div>
      </div>
    </div>
  </transition>
</template>
<script>
  export default {
    name: 'modal-dialog',
    data () {
      return {
        isOpen: false,
        action: ''
      }
    },
    props: {
      id: {
        required: false
      },
      open: {
        type: Boolean,
        default: false
      }
    },
    mounted () {
      this.isOpen = this.open
    },
    methods: {
      toggleModal () {
        this.isOpen = !this.isOpen
        if (this.isOpen) {
          this.action = 'open'
        } else {
          this.action = 'closed'
        }
      },
      closeModal () {
        this.isOpen = false
        this.action = 'closed'
      },
      openModal () {
        this.isOpen = true
        this.action = 'opened'
      },
      confirmModal () {
        this.isOpen = false
        this.action = 'confirmed'
      },
      cancelModal () {
        this.isOpen = false
        this.action = 'cancelled'
      }

    },
    watch: {
      isOpen (open) {
        if (open) {
          this.$nextTick(() => {
            this.$refs.dialog.focus()
          })
        }
      },
      action (action) {
        this.$emit('input', action)
      }
    }
  }
</script>
