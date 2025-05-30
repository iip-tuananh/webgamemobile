<script>
    class User extends BaseClass {
        no_set = [];

        before(form) {
			this.all_roles = @json(\App\Model\Common\Role::getForSelect());
            this.image = {};
        }

        after(form) {
            if (!this.id) {
                this.password = "123456@";
                this.password_confirm = "123456@";
            }
        }

        get upgrade_to_date() {
            return this._upgrade_to_date ? moment(this._upgrade_to_date).toDate() : '';
        }

        set upgrade_to_date(value) {
            this._upgrade_to_date = value ? moment(value).format('YYYY-MM-DD') : '';
        }

        get image() {
            return this._image;
        }

        set image(value) {
            this._image = new Image(value, this);
        }

        get submit_data() {
            let data = {
                name: this.name,
                email: this.email,
                account_name: this.account_name,
                phone_number: this.phone_number,
                password: this.password,
                password_confirm: this.password_confirm,
                roles: this.roles,
                status: this.status,
                address: this.address,
                type: this.type,
                upgrade_type: this.upgrade_type,
                bank_name: this.bank_name,
                bank_account_number: this.bank_account_number,
                bank_account_name: this.bank_account_name,
                upgrade_to_date: this._upgrade_to_date,
            }

            data = jsonToFormData(data);
            let image = this.image.submit_data;
            if (image) data.append('image', image);
            return data;
        }
    }
</script>
