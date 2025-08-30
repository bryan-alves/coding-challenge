<template>
  <div class="chat-content">
    <div class="chat-content__divider">Hoje</div>

    <div class="chat-content__row">
      <div class="chat-content__msg chat-content__received">
        <div class="chat-content__text">Olá! 👋 Precisando de ajuda com seu projeto?</div>
        <div class="chat-content__time">09:31</div>
      </div>
    </div>

    <div class="chat-content__row chat-content__sent">
      <div class="chat-content__msg chat-content__sent" style="background: var(--third-color)">
        <div class="chat-content__text">
          Oi! Quero replicar o estilo do WhatsApp Web só com HTML e CSS.
        </div>
        <div class="chat-content__time">
          09:32
          <span class="chat-content__checks">
            <span class="chat-content__check chat-content__read"></span
            ><span class="chat-content__check chat-content__read"></span>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.chat-content {
  overflow: auto;

  &__divider {
    display: inline-block;
    margin: 16px auto;
    padding: 6px 12px;
    background: var(--secondary-text-color);
    color: var(--white);
    font-size: 12px;
    border-radius: 999px;
  }

  &__msg {
    max-width: min(72ch, 86%);
    margin: 2px 0;
    padding: 8px 10px 6px;
    border-radius: 14px;
    position: relative;
    display: inline-flex;
    flex-direction: column;
    gap: 4px;
    box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
    word-wrap: break-word;
    white-space: pre-wrap;
  }

  &__msg &__text {
    font-size: 14.5px;
    line-height: 1.35;
  }

  &__time {
    align-self: flex-end;
    display: flex;
    gap: 6px;
    font-size: 11.5px;
    color: var(--third-text-color);
  }

  &__row.received {
    justify-content: flex-start;
  }

  &__sent {
    border-top-right-radius: 4px;
  }

  &__row.chat-content__sent {
    justify-content: flex-end;
  }

  &__row {
    display: flex;
    width: 100%;
  }

  &__checks {
    display: inline-flex;
    gap: 2px;
    transform: translateY(1px);
  }

  &__check {
    width: 10px;
    height: 2px;
    border-bottom: 2px solid currentColor;
    border-left: 2px solid transparent;
    display: inline-block;
    transform: skewX(-30deg);
    opacity: 0.85;
  }

  &__check.chat-content__read {
    color: var(--check-message-color);
  }

  &__received {
    background: var(--primary-background-color);
    border-top-left-radius: 4px;
  }
}
</style>
