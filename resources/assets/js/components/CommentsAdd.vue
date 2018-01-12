<template>
    <div>
        <div class="col-md-1"><i class="fa fa-user fa-4x"></i></div>
        <div class="col-md-11">
            <div class="form-group">
                    <textarea  v-model="body" name="body" required rows="2" class="form-control" placeholder="Pridať nový komentár ..."></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary pull-right" style="margin-bottom: 20px">Vložiť komentár</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                body: ''

            }
        },

        methods: {

        },

        computed: {

        }
    }
</script>