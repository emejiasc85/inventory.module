class Group{
    static get(params, then) {
        axios.get('/api/colors', {
            params: params
        })
        .then(({data}) => then(data));
    }

}

export default Group;