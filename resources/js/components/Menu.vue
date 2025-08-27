<template>
  <div class="menu">
    <slot />
  </div>
</template>

<style lang="css" scoped>
.menu {
  width: 100%;
  max-height: calc(100vh - 80px);
  min-height: calc(100vh - 80px);
  max-width: 365px;
  padding: 10px;
  overflow-y: auto;
}

.menu::-webkit-scrollbar {
  width: 7.5px;
}

.menu::-webkit-scrollbar-track {
  background: #19b2b2c2;
}

.menu::-webkit-scrollbar-thumb {
  background: #4d4d4d;
  border-radius: 5px;
}

.menu::-webkit-scrollbar-thumb:hover {
  background: #363636;
}
</style>