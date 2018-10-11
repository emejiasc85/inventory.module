<template>
    <div>
        <transition name="modal" tabindex="-1">
            <div class="modal-mask" >
                <div class="modal-dialog" :class="size" role="document">
                    <div class="modal-content">
                    <div class="modal-header" style="border-top: 2px solid #4dbd74">
                        <h4 class="modal-title">{{ title }}</h4>
                    </div>
                    <div class="modal-body">
                         <slot></slot>
                    </div>
                    <div class="modal-footer">
                        <slot name="btnCancel"></slot>
                        <slot name="btnSave"></slot>
                    </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        props: ['title', 'size']
    }
</script>

<style>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .7);
        display: table;
        transition: opacity .3s ease;
    }
</style>