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
        $base64(file) { //문자열형태로 바꿔줌 프로미스객체로
            return new Promise(resolve => {
                const fr = new FileReader();
                fr.onload = e => {
                    resolve(e.target.result);//이미지의 문자열을 resolve로 보냄
                }
                fr.readAsDataURL(file);//파일정보를 url읽어줌
            });
        }
    }
};