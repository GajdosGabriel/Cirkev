<script>
    export default {
        data: function() {
            return {

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


    .numberCircle {
        border-radius: 50%;
        /*behavior: url(PIE.htc); !* remove if you don't care about IE8 *!*/

        width: 36px;
        height: 36px;
        padding: 2px;

        background: #ff0010;
        border: 2px solid #666;
        color: #dbf5fa;
        text-align: center;

        font-size: 20px ;
    }
</style>