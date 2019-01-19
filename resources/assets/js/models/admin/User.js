class User{
    static get(params, then) {
        axios.get('/api/admin/users', {
            params: params
        })
        .then(({data}) => then(data));
    }

}

export default User;