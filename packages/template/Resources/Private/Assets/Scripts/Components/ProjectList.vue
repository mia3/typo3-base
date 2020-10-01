<template>
  <div class="project-list">
    <div class="container">
      <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna quyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam.</p>
      <div v-for="parent in data.categories">
        <h3>{{ parent.title }}</h3>
        <ul class="project-list__category-list">
          <li v-for="child in parent.children" class="project-list__category-list-item">{{ child.title }}</li>
        </ul>
      </div>

      <ul class="project-list__result-list">
        <li v-for="(project, i) in data.projects" :class="resultListItemClass(i)" class="project-list__result-list-item">
          {{ i }} {{ resultListItemClass(i) }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'project-list',
    props: ['data'],
    components: {},
    data () {
      return {};
    },
    computed: {},
    methods: {
      resultListItemClass (i) {
        switch (i) {
          case 0:
            return 'project-list__result-list-item--a';

          case 1:
            return 'project-list__result-list-item--b';

          case 2:
            return 'project-list__result-list-item--c';

          case 3:
            return 'project-list__result-list-item--c';

          case 4:
            return 'project-list__result-list-item--e';

          case 5:
            return 'project-list__result-list-item--f';

          case 6:
            return 'project-list__result-list-item--g';

          default:
            return '';
        }
      },
      placeholder (i) {
        switch (i) {
          case 0:
            return '/typo3conf/ext/template/Resources/Public/Placeholder/a.png';

          case 1:
            return '/typo3conf/ext/template/Resources/Public/Placeholder/b.png';

          case 2:
            return '/typo3conf/ext/template/Resources/Public/Placeholder/c.png';

          case 3:
            return '/typo3conf/ext/template/Resources/Public/Placeholder/d.png';

          case 4:
            return '/typo3conf/ext/template/Resources/Public/Placeholder/e.png';

          case 5:
            return '/typo3conf/ext/template/Resources/Public/Placeholder/d.png';

          case 6:
            return '/typo3conf/ext/template/Resources/Public/Placeholder/d.png';

          case 7:
            return '/typo3conf/ext/template/Resources/Public/Placeholder/d.png';

          case 8:
            return '/typo3conf/ext/template/Resources/Public/Placeholder/e.png';

          case 9:
            return '/typo3conf/ext/template/Resources/Public/Placeholder/f.png';

          case 10:
            return '/typo3conf/ext/template/Resources/Public/Placeholder/g.png';

          default:
            return '/typo3conf/ext/template/Resources/Public/Placeholder/a.png';
        }
      },
    },
  };
</script>
