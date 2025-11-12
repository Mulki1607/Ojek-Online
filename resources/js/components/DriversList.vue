<template>
  <div>
    <h2>Daftar Driver</h2>
    <ul>
      <li v-for="driver in drivers" :key="driver.id">{{ driver.name }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      drivers: [
        { id: 1, name: "Budi" },
        { id: 2, name: "Siti" },
      ],
    };
  },
};
</script>

<style scoped>
h2 { color: #2c3e50; }
</style>
