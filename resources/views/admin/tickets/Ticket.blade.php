<script>
    class Ticket extends BaseClass {
        no_set = [];

        before(form) {
            if (!this.ip_ids) this._ip_ids = [];
        }

        after(form) {
            if (this._ip_ids.length == 0) this._ip_ids = [];
        }

        set ip_ids(value) {
            this._ip_ids = value;
        }

        get ip_ids() {
            return this._ip_ids;
        }

        get submit_data() {
            let data = {
                title: this.title,
                message: this.message,
                ip_ids: this.ip_ids,
            }
            data = jsonToFormData(data);

            return data;
        }
    }
</script>
