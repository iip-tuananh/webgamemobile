<script>
    class IpProduct extends BaseClass {
        no_set = [];

        before(form) {
            if (!this._username) this._username = 'user';
            if (!this._password) this._password = '123456';
        }

        after(form) {

        }

        get product_id() {
            return this._product_id;
        }

        set product_id(value) {
            this._product_id = value;
        }

        get username() {
            return this._username;
        }

        set username(value) {
            this._username = value;
        }

        get password() {
            return this._password;
        }

        set password(value) {
            this._password = value;
        }

        get submit_data() {
            let data = {
                ip: this.ip,
                product_id: this.product_id,
                data_center: this.data_center,
                username: this.username,
                password: this.password,
            }
            data = jsonToFormData(data);

            return data;
        }
    }
</script>
