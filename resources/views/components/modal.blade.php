@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$maxWidthClass = 'modal-panel--' . $maxWidth;
@endphp

<div
    x-data="{
        show: @js($show),
        focusables() {
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)]
                .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
    }"
    x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('modal-no-scroll');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
        } else {
            document.body.classList.remove('modal-no-scroll');
        }
    })"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    class="modal-wrapper"
    style="display: {{ $show ? 'block' : 'none' }};"
>
    <div
        x-show="show"
        class="modal-backdrop"
        x-on:click="show = false"
        x-transition:enter="modal-fade-enter"
        x-transition:enter-start="modal-fade-enter-start"
        x-transition:enter-end="modal-fade-enter-end"
        x-transition:leave="modal-fade-leave"
        x-transition:leave-start="modal-fade-leave-start"
        x-transition:leave-end="modal-fade-leave-end"
    >
        <div class="modal-backdrop-bg"></div>
    </div>

    <div
        x-show="show"
        class="modal-panel {{ $maxWidthClass }}"
        x-transition:enter="modal-scale-enter"
        x-transition:enter-start="modal-scale-enter-start"
        x-transition:enter-end="modal-scale-enter-end"
        x-transition:leave="modal-scale-leave"
        x-transition:leave-start="modal-scale-leave-start"
        x-transition:leave-end="modal-scale-leave-end"
    >
        {{ $slot }}
    </div>
</div>
