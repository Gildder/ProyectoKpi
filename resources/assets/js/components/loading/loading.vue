<template>
    <div id="Gen" class="marginLeft" v-if="opcion == 'Gen'">
        <div class="block" id="rotate_01"></div>
        <div class="block" id="rotate_02"></div>
        <div class="block" id="rotate_03"></div>
        <div class="block" id="rotate_04"></div>
        <div class="block" id="rotate_05"></div>
        <div class="block" id="rotate_06"></div>
        <div class="block" id="rotate_07"></div>
        <div class="block" id="rotate_08"></div>
        <div class="clearfix"></div>
    </div>
    <div id="facebook" class="marginLeft" v-if="opcion == 'facebook'">
        <div id="block_1" class="facebook_block"></div>
        <div id="block_2" class="facebook_block"></div>
        <div id="block_3" class="facebook_block"></div>
        <div class="clearfix"></div>
    </div>
    <div id="circle" class="marginLeft" v-if="opcion == 'circle'">
        <div id="circle_1" class="circle"></div>
        <div id="circle_2" class="circle"></div>
        <div id="circle_3" class="circle"></div>
        <div class="clearfix"></div>
    </div>
    <div id="outer-bar" class="marginLeft" v-if="opcion == 'outer'">
        <div id="front-bar" class="bar-animation">
            <div id="bar_1" class="bar-line"></div>
            <div id="bar_2" class="bar-line"></div>
            <div id="bar_3" class="bar-line"></div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div id="circular" class="marginLeft" v-if="opcion == 'circular'">
        <div id="circular_1" class="circular"></div>
        <div id="circular_2" class="circular"></div>
        <div id="circular_3" class="circular"></div>
        <div id="circular_4" class="circular"></div>
        <div id="circular_5" class="circular"></div>
        <div id="circular_6" class="circular"></div>
        <div id="circular_7" class="circular"></div>
        <div id="circular_8" class="circular"></div>
        <div class="clearfix"></div>
    </div>
</template>

<script>
    export default {
        props: {
            opcion: {
                type: String, required: true
            }
        },
    }
</script>
  