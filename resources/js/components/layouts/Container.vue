<template>
  <div class="container">
    <slot />
  </div>
</template>

<style lang="css" scoped>
.container {
  width: 100%;
  max-width: 100% !important;
  display: flex;
  min-height: 100vh;
  height: 100%;
  background: var(--container-background-color);
}
</style>
