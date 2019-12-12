<template>
  <div>
    <h1>{{ stream1 }}</h1>
    <h1>Mwakalonge {{ stream1 }}</h1>
  </div>
</template>

<script>
export default {
  props: ["stream1"],
  data() {
    return {};
  },
  methods: {
    editModal(user) {
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(user);
    }
  }
};
</script>