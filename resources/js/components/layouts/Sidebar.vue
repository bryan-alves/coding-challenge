<template>
  <div class="sidebar">
    <slot />
  </div>
</template>

<style lang="css" scoped>
.sidebar {
  width: 100%;
  max-height: calc(100vh - 80px);
  min-height: calc(100vh - 80px);
  max-width: 450px;
}
</style>