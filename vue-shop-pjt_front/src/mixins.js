import axios from 'axios';

export default {
    methods: {
        async $api(url, data) {
            return (
              await axios({
                method: 'post',
                url,
                data,
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
        }
    }
};