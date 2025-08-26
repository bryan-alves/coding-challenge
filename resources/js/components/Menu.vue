<template>
  <div class="menu">
    <slot />
  </div>
</template>

<style lang="css" scoped>
.menu {
  background: #19b2b2c2;
  width: 100%;
  max-height: 100vh;
  max-width: 365px;
  padding: 10px;
  overflow-y: auto;
}
</style>