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
        },
        async $delete(url) {
          return (
            await axios({
              method: 'delete',
              url,
            }).catch((e) => {
              console.error(e);
            })
          ).data;
        },
        $currencyFormat(value, format = '#,###') {
          if (value == 0 || value == null) return 0;
    
          var currency = format.substring(0, 1);
          if (currency === '$' || currency === '₩') {
            format = format.substring(1, format.length);
          } else {
            currency = '';
          }
    
          var groupingSeparator = ",";
          var maxFractionDigits = 0;
          var decimalSeparator = ".";
          if (format.indexOf(".") == -1) {
            groupingSeparator = ",";
          } else {
            if (format.indexOf(",") < format.indexOf(".")) {
              groupingSeparator = ",";
              decimalSeparator = ".";
              maxFractionDigits = format.length - format.indexOf(".") - 1;
            } else {
              groupingSeparator = ".";
              decimalSeparator = ",";
              maxFractionDigits = format.length - format.indexOf(",") - 1;
            }
          }
    
          var prefix = "";
          var d = "";
          // v = String(parseFloat(value).toFixed(maxFractionDigits));
    
          var dec = 1;
          for (var i = 0; i < maxFractionDigits; i++) {
            dec = dec * 10;
          }
    
          var v = String(Math.round(parseFloat(value) * dec) / dec);
    
          if (v.indexOf("-") > -1) {
            prefix = "-";
            v = v.substring(1);
          }
    
          if (maxFractionDigits > 0 && format.substring(format.length - 1, format.length) == '0') {
            v = String(parseFloat(v).toFixed(maxFractionDigits));
          }
    
          if (maxFractionDigits > 0 && v.indexOf(".") > -1) {
            d = v.substring(v.indexOf("."));
            d = d.replace(".", decimalSeparator);
            v = v.substring(0, v.indexOf("."));
          }
          var regExp = /\D/g;
          v = v.replace(regExp, "");
          var r = /(\d+)(\d{3})/;
          while (r.test(v)) {
            v = v.replace(r, '$1' + groupingSeparator + '$2');
          }
    
          return prefix + currency + String(v) + String(d);
        }
    }
};