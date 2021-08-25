function getTitle(vm) {
    const {
        title
    } = vm.$options
    if (title) {
        return typeof title === 'function' ?
            title.call(vm) :
            title
    }
}
export default {
    created() {
        const title = getTitle(this)
        if (title) {
            axios.get('/api/company-details').then((resp) => {
                // console.log(resp.data[0]);
                document.title = `${title} - ` + resp.data[0].company_id;
            });
        }
    },
}
