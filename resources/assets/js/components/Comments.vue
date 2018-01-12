<script>
    export default {
        props: ['attributes'],

        data: function () {
            return {
                editing: false,
                body: this.attributes.body,
                panel: false
            };
        },

        methods: {
            update: function() {
                axios.patch('comments/replies/' + this.attributes.id, {
                    body: this.body
                });

                this.editing = false;
            },

            destroy: function() {
                axios.delete('comments/replies/' + this.attributes.id);
                $(this.$el).fadeOut(300);
                },

            addLike: function() {
                axios.post('/comments/' + this.attributes.id + '/favorites')

            }


        }


    }

</script>