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
  overflow-y: auto;
}

.sidebar::-webkit-scrollbar {
  width: 7.5px;
}

.sidebar::-webkit-scrollbar-track {
  background: #19b2b2c2;
}

.sidebar::-webkit-scrollbar-thumb {
  background: #4d4d4d;
  border-radius: 5px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
  background: #363636;
}
</style>