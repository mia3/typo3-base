<template>
	<div>
		Counter: {{counter}}
		<button @click="addOne" class="btn btn-default">Add One</button>
	</div>
</template>

<script>
    export default{
        name: "example",
        data: function () {
            return {
                counter: 0
            }
        },
        methods: {
            addOne: function () {
                this.counter++;
            }
        }
    }
</script>
