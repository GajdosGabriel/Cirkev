<template>

    <div>

        <button v-if="!showForm" :class="classes" @click="subscribe" >{{ buttonText }}</button>


    <!--<button :class="classes" @click="subscribe" >{{ buttonText }}</button>-->

        <transition name="slide-fade">
        <div style="background: red;  padding: 5px" v-if="showForm" class="pull-right"><a href="/login"><span style="color: wheat;">Najprv sa prihláste</span></a></div>
        </transition>

    <!--<transition name="slide-fade">-->
        <!--<div v-if="showForm" class="pull-right">-->
        <!--<input class="input-xs " type="text" placeholder="meno" required >-->
        <!--<input class="input-xs " type="email" placeholder="email" required>-->
        <!--</div>-->
    <!--</transition>-->

    </div>
</template>

<script>
    export default {
        props: ['active2'],

        data: function() {
        return {
            active: this.active2,
            signedIn: window.Laravel.signedIn,
            showForm: false
        }
    },

        computed: {
            classes: function() {
        return ['pull-right', this.active ? 'btn-info' : ''];
        },

        buttonText: function() {
            return this.active ? 'Zrušiť sledovanie' : 'Sledovať diskusiu!';
        }
//            ,
//
//            signedIn: function() {
//            return window.App.signedIn;
//        }

    },

        methods: {
            subscribe: function () {

                if(this.signedIn) {
                    axios[(this.active ?  'delete' : 'post')](location.pathname + '/subscriptions');
                    this.active = ! this.active;
                } else {
//                    this.signedIn = true;
                    this.showForm = true;


                }

            }
        }



    }
</script>
<style>
    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */ {
        transform: translateX(10px);
        opacity: 0;
    }
</style>