<script setup>
import { Icon } from "@iconify/vue";
import { useGlobalStore } from "@/stores/global";
import { reactive } from "vue";

const props = defineProps({
  channel: String,
  selected: {
    type: Boolean,
    default: false,
  },
  disabled: {
    type: Boolean,
    default: false,
  },
  small: {
    type: Boolean,
    default: false,
  },
  onlyIcon: {
    type: Boolean,
    default: false,
  },
});

const store = useGlobalStore();

const bind = reactive({
  icon: store.getChannelIcon(props.channel),
  width: props.small ? "16" : "20",
  height: props.small ? "16" : "20",
  color: props.selected ? "0c6f64" : "556377",
});

function capitalizeFirstLetter(str) {
  if (!str) return "";
  return str.charAt(0).toUpperCase() + str.slice(1);
}
</script>

<template>
  <div
    class="channels-badge"
    :class="{
      'channels-badge--small': small,
      'channels-badge--selected': selected,
      'channels-badge--disabled': disabled,
    }"
  >
    <Icon v-bind="bind" />
    <span v-show="!onlyIcon">{{ capitalizeFirstLetter(channel) }}</span>
  </div>
</template>

<style lang="scss" scoped>
.channels-badge {
  padding: 8px 12px;
  cursor: pointer;
  display: flex;
  border: 1px solid var(--primary-gray-color);
  border-radius: 100px;
  min-width: fit-content;
  gap: 0.5rem;
  align-items: center;
  font-weight: 400;

  span {
    font-size: 14px;
    color: var(--secondary-text-color);
  }

  &--small {
    gap: 0.25rem;
    padding: 4px 6px;

    span {
      font-size: 12px;
    }
  }

  &--selected {
    background: var(--selected-background-color);
    border: 1px solid var(--border-color);

    span {
      color: var(--selected-channel-color);
    }
  }

  &--disabled {
    background-color: var(--disabled-color) !important;
    border: 0;
  }
}
</style>
