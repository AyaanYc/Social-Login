import axios from 'axios';

export default {
    methods: {
        async $post(url, param) {
            return (
              await axios({
                method: 'post',
                url,
                data: param
              }).catch((e) => {
                console.error(e);
              })
            ).data;
          },
        async $get(url, param) {
          return (
            await axios.get(url, {
              params: param
            }).catch((e) => {
              console.error(e);
            })
          ).data;
        },
        $base64(file) {
            return new Promise(resolve => {
                const a = new FileReader();
                fr.onload = e => {
                    resolve(e.target.result);
                }
                fr.readAsDataURL(file);
            });
        },
    }
};