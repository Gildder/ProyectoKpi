<template>
    <select v-model="id" class="form-control" required>
        <option value="">Seleccionar..</option>
        <option v-for="item in items" :value="item.id">
            {{ item.nombre }}
        </option>
    </select>
</template>

<script>
    export default {
        props: ['items', 'id'],
        data: function () {
            return {

            };
        },
    }
</script>
