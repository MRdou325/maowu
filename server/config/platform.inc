<?php
/**
 * 2013-10-08 lizhien 平台相关
 */
$alipayConfig = array(
	"AlipayPartner" => "2088901261858864", 
	"AlipaySeller" => "cosiray@gmail.com", 
	"AlipayNotifyUrl" => "http://notify.java.jpxx.org/index.jsp", 
	"AlipayRsaPrivate" => "MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBANAlpdRQ5he7e0H34b9jUukf4slqsUVXCJLXM7Coi3SyvZsiOWT5pKXaq7iZyMQPGDGBYcqQU2TV/XysZvx+mR39kjTbfCYzVAQS2YxcoYdeGlXX8+VPH8uGA83kmFXM9jlVl9sawoBvZTEYNKDZ7WFSNqaXxWjakB5tGPUjY6/RAgMBAAECgYA3yW9ZqVkSEUim1KYnoppNKyOgcj0S5ZHBsXYEKhg+bc2Nr62MV7B+V05hCq6ZhaYpVpD8NpRzWTs4WAi+MbwdpuJSFLV5vAB2Uv1aqONWB2jWDkzuX/JTPeYsJr23ro8fcztYtTfq5qSHDQ4oltx0Q327NusWg4GIK7KiTOys5QJBAOm2Yf+oq59gCGLA3AglqFAZmo+dmafFQqGCmP40D9Vsvq0OYucME/KWerl1eWcgIVEcKF69BuIOw6sNVKa1ORsCQQDj/yNWm4zcpcHkxez4gTEzLyiw3XppCaiPQLbJ4tEmFzNpz8NPd8CAQV+7LLraoSGhyWe5luZbM+VmuY7qrNWDAkBu70dtFx7/s5HHbkwDAfz2qHCZIvHAlP2ftGHyp7usTsXjVyTTDwSY7ZyrU3ug27t0yKzQ62DNBL0UAGviBbtpAkEAwt/AhLZPoAjNwYyrD3zdYLJeRU4I4t6uhEL7+XM08SnDeB1tAu+ISheWi5Wf4F75MB/F2ItyOWISIctYrJ0toQJBAKJQrJwshD9ZMSE74aEpolNrlGjTez+aoQTwsek1S3Cr5oWGGoI/erRG3M4ymxkUzk+yHSZJTucjwG8hcHbEGns=", 
	"AlipayPublic" => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCIQt87F16nbaCrF09LBH4MZGbw62n9D9UkV2Na RLeLNIvbVFiRISaNuqlJPrDEWL4yxrAveZLBAYULgCi6EQMNikK/5Ph3B2QkYm8fYnbsqUFDXQmz 5Wm5kLQiTEagqxAe53Nv+tsmkI0Prxa4BmsyzJzZKvSZ6bu0o04siX9lVwIDAQAB", 
	"AlipayPluginName" => "alipay_plugin.apk" 
);

$nd91IOSConfig = array(
	"AppId" => "116274", 
	"AppKey" => "da069aa5bd318079b3d4dd41aabce2de8999566d998319d8", 
	"Orientation" => "portrait" 
);

$nd91Config = array(
	"AppId" => "102906", 
	"AppKey" => "20c364a6d3b22eed29a8c8eb5c9bc098cda3146b3af506f9", 
	"Orientation" => "portrait" 
);

$ppConfig = array(
	"AppId" => "4793", 
	"AppKey" => "8a931824f5fe9a93409e3329ce3fa3c1", 
	"ZoneId" => "21185", 
	"IsLog" => "0", 
	"RechargeAmount" => "10", 
	"IsLongComet" => "1", 
	"IsLogOutPushLoginView" => "0", 
	"IsOpenRecharge" => "1", 
	"LoginUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/pp/login.php?sid=", 
	"PayCheckUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/pp/paycheck.php?Platform=10" 
);

$qh360Config = array(
	"AppId" => "203088291",
	"AppKey" => "e241616d1969503a20d1db559eda17a2",
	"AppSecret" => "5f7fde877cbfeba7b1e3bfc8b9215d6f",
	"PrivateKey" => "2701da37100280a014f1c5921ac5e79d",
	"NotifyUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/qh360/paycallback.php",
	"QHAppName" => "wushuang", 
	"QHExchangeRate" => "1", 
	"QHNotifyUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/qh360/pay_callback.php?Platform=5&appkey=", 
	"QHGetTokenByCode" => "http://" . SERVER1 . "/wushuang/server/transaction/qh360/user.php?type=get_token_by_code&code=", 
	"QHGetTokenByRefreshToken" => "http://" . SERVER1 . "/wushuang/server/transaction/qh360/user.php?type=get_token_by_refresh_token&refresh_token=", 
	"QHGetUserInfoByCode" => "http://" . SERVER1 . "/wushuang/server/transaction/qh360/user.php?type=get_info_by_code&code=", 
	"QHGetUserInfoByToken" => "http://" . SERVER1 . "/wushuang/server/transaction/qh360/user.php?type=get_user_by_token&token=", 
	"QHGetUserInfoByRefreshToken" => "http://" . SERVER1 . "/wushuang/server/transaction/qh360/user.php?type=get_info_by_refresh_token&refresh_token=", 
	"QHPayCallBackCheck" => "http://" . SERVER1 . "/wushuang/server/transaction/qh360/pay_callback.php?type=pay_call_back_check&Platform=5&appkey="
);

$ucConfig = array(
	"CpID" => "73245", 
	"GameID" => "642088", 
	"ServerID" => "0", 
	"ApiKey" => "b650cba6de78cca2f67107121678d15e", 
	"NotifyUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/uc/paycallback.php"
);

$tbConfig = array(
	"AppId" => "160360",
	"AppKey" => "BVulfZMoTfp0f9eeyimNDqXQw007ScGa",
);

$tbAndroidConfig = array(
	"AppId" => "100161000",
	"AppKey" => "O4*h7JFEzTiSkpjYxcSHIivAwvgeiPTs",
);

//沙盒测试环境验证
// "https://sandbox.itunes.apple.com/verifyReceipt"
//正式环境验证
// "https://buy.itunes.apple.com/verifyReceipt"
$appleConfig = array(
	"AppStoreCheckUrl" => "https://sandbox.itunes.apple.com/verifyReceipt",
	"product_id_125" => "com.tongbu.wushuangen.store0013",
	"product_id_250" => "com.tongbu.wushuangen.store0011",
	"product_id_450" => "com.tongbu.wushuangen.store0012",

	"product_id_100" => "com.tongbu.wushuangen.store0001",
	"product_id_300" => "com.tongbu.wushuangen.store0002",
	"product_id_500" => "com.tongbu.wushuangen.store0003",
	"product_id_800" => "com.tongbu.wushuangen.store0004",
	"product_id_1000" => "com.tongbu.wushuangen.store0005",
	"product_id_1500" => "com.tongbu.wushuangen.store0006",
	"product_id_3000" => "com.tongbu.wushuangen.store0007",
	"product_id_5000" => "com.tongbu.wushuangen.store0008",
	"product_id_10000" => "com.tongbu.wushuangen.store0009",
);

$googleConfig = array(
	"product_id_125" => "com.tongbu.wushuangen.store0013"
);

$xiaomiConfig = array(
	"AppId" => "2882303761517485498",
	"AppKey" => "5861748549498",
	"AppSecret" => "NJW8QnFP3TOFyYu92AY/Aw==",
	"NotifyUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/xiaomi/paycallback.php",
);

$oppoConfig = array(
	"AppId" => "6406", 
	"AppKey" => "717hryyo0h0kWs0csgkg8scc4", 
	"AppSecret" => "2dD40BB27d79EA38A1ee0419354f46CF",
	"NotifyUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/oppo/paycallback.php", 
	"PayCallBackCheck" => "http://" . SERVER1 . "/wushuang/server/transaction/oppo/paycallbackcheck.php" 
);

$vivoConfig = array(
	"AppId" => "00ecaa2a446f23ce660efdc6ae24ee9a", 
	"CpId" => "20160426155804648953", 
	"CpKey" => "d0f35efccb41942d8fbfc86fa1e3bbc6", 
	"NotifyUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/vivo/paycallback.php", 
	"PayCallBackCheck" => "http://" . SERVER1 . "/wushuang/server/transaction/vivo/paycallbackcheck.php" 
);

$amigoConfig = array(
	"APIKey" => "1A6F21A16C7E4E58ADC9F68529AB4BF5",
	"SecretKey" => "0A925722676C402286B2D693A63A943D",
	"PublicKey" => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCt4+KVTijj4D50XRR0ZqvLNTpy6cCtWKqWO2xJPvfVT0OJz7ku0IezSLYg4k/efyLA31Nshqe0l/9j/LuQiuDyr5u3TWaZZVOBkgCChD18YB01xt4yWJzjHQYaaF8n0I0tcpTPUd7MAHCNOp2bJmvhkRZ+RT5v8vnZHp1cxTSWxwIDAQAB",
	"PrivateKey" => "MIICeAIBADANBgkqhkiG9w0BAQEFAASCAmIwggJeAgEAAoGBAKX32oYtdiCZhEmmVxk3oPwonqvDLhMp40YZastCaxvHGQ//beguEnkiBcdLrwmV97i6KzZGj0E3zYGBVU09+5ZukND34y607Ux+fe9M3RWtwCQFnT8L9Srs+KDFThjpmo885sgJIlqbgBt90e8kEd7lBk3C/3VZGkIpqZlb2A3pAgMBAAECgYEAirq0CeZkUHmiT2Hgei66vSxC/XYnxFMGK+lBEGgTWePBulKbjzE7tc9PnzhPNqcJq3rKdhLi2fQILtFp+SfvbIWRbuV6Thqhc1pUe0yVBiGa7cd1fiP91nCG6WqTY1tbYVUnNsXihp1OKA+u0Q9UuHa+NJl5V9D8oxreYT21tYECQQDSbIhtMK/bFVxqzp/7egraJH5qrfzw+IBeFwmtvbIoHKUqlO4e+SwXZ6JzNmrnsZSe3rZj9F3+mbgai3wRGxfRAkEAyepctPSkKpfO5gYx4HMENz+p1lfXMNWFmxX5/Npt2wSRaiiPQYT2+yUunOV9NOxpMbJ3ab6/zh0hrVksWAAymQJBANA+bL1yw3aTq0RgfF9JplfAagN1cK+hnph/QCrbYubjgmmjvgyVF5eKDnDq1924FpcrXWGKQ0NmKZbLl9rt7yECQQDHfNm9Gpr7TeLnFiW++EOpBigZEc4UfFC1CYBj1baFlbzJYmsus1yEgpbMAluypwPDSux5uDCuRc/ZAWozQ3a5AkBtIa4g4uXUJ0BBzlv6apb1l+jlsf3B1B5g2J673XmJyZJxZjH0TG3+tyhkF9AeBpGY4PUdXypkYlagPebF2e9d", 
	"NotifyUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/amigo/pay.php", 
	"PayCheckUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/amigo/paycheck.php" 
);

$coolpadConfig = array(
	"PrivateKey" => "MIICWwIBAAKBgQCNvcxv49M51naFRvO1kb689xoOsCiv/RABUxkXweugNsxAojTlkvzWtEnfK0DPCOuA2sajO0GGsiJVm4YTx3V3irkTrfJ2xfxPS1LgqJ2MAzXdOK39qc7SITavVwXgyIyzFJGbsTgi6feUkH7g3k8BD5ySfZgVO+qkfrK9fY//IwIDAQABAoGAHxKPoavBH3nLa7Y9MP2tYcGN3dByavpAKvorkxC49dttdXHZxMYvVWYal6jkwT5EWnAbgac42y1r53Z7sxRTxLd2DRaAq3rWq3xrEZ04w2XTWDaOQzUJSai4uQR0ass0CBaYm4mjLm1GdWIwUsHQTTgD27Ftx0LmS5VxGv4HeAECQQDfkXaDmTydK4pJ6DXWtLqL1KtoWRDQM7rf/ebCo2sHJBwbIefDqq1M+wXoIspYhXlsQNKwSvf/catmEQSGngQBAkEAok2TWvZH3ua3X2rzqEK4S8Oo2AnpvofRCA2K2lCefuCA+Zok9wBe2ckjidd3CyiS4ELTgRUmxmDx5vV/dilzIwJAYgHozIQOuG/v7bpob7lG1injApmY70zeLXenA8iUEMtZruNMMNDPrCGXU059GhVZR4WbV0FmOotgMhxfuYvoAQJAaaU7TJNQ1vuw0vBIJ/c+BTsX1YAmYToAy1AdWNvvP0EdUtuOQiVAmFx/wIK6302KxWVaTQSal7iU3TRhwmVapwJAEoQVXHB0DQF4OllODAjt/z12h4OTADOE3meLgqetCggLbznYlBawHX2gz5nZ4weeU8uXaXFXo6zsEQqzYFmmqg==",
	"PublicKey" => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC+0kL+3qAVqcNu2BSqVVfZWxt9VTJNhM1R7ARBWSTunz4Q760Lr8+yDYPSnWUG19nYowItv42dkHkeCxZp5tkGq+0JwoIc8CMVvaqYoaGsCbqfqs1iqLeaimS84+P1ifK4Gb7uReudk3FNFIOF3OsoW6I6bMjWfU9z5AArntPedwIDAQAB",
	"AppKey" => "891092db852c45219df7140fed28f3a4",
	"AppId" => "5000003604",
	"NotifyUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/coolpad/paycallback.php"
);

$huaweiConfig = array(
	"AppId" => "10514097", 
	"CpId" => "37787792",
	"PayId" => "37787792",
	"buoyPrivateKey" => "MIICeAIBADANBgkqhkiG9w0BAQEFAASCAmIwggJeAgEAAoGBAOWfhUWLakTJ/5Z6W8sDetoG+6bghB61AmOLBO65JBvX8ojh5Du7Va5VCKH2ELugmuKCUsm70axER/z8qQG7ec7E/VQgMnWfsrN7WY3+zODsWC0RJNTrEF6kAOuxdHbhvY4Dh7d0TZBHIUmZGA1KYDoaBvOw/ECESznYEcyDLo1BAgMBAAECgYEAjWrDP2NvXVIykNBmvA82mBR44/ueIvNDt16k+QkZDfTfMCI+1/K2ABnqqSTMhWGSQjIVHp0HstqSo2JQC/sUNnMC0whrZxr8rgFXm28GAFN0u8tHcE5ZfGIQ/+T19TBHQvtMsGgruPQMurDHPdeq7VV0mdj3zfI5EWOozZnlQAECQQD8oL9Nukp6mEvHdPfkWJeYaqIoqfIfl5MbrkyeNlgizXV44Ht2hLgyAfa+tZzJ1l5gauKls7iEDySdw9vznXfBAkEA6LAp8QM6CO5BGfxg/IVQaN1MMUKHOMGT/KMidL316SOAQJLjnux+urrJ62IUkRM7jy2VOgFPjTYpUQW9f5p1gQJBAJ6DtsXs2ILoQNRcfpcXR7fpYOqnCDfuge3ihkzXyKG9zbIVGSMa0AEA3nR3vHOhQQK6zpAunt6uKcmcdcz8x4ECQAOeMZjAvxdCdRqtVOi4Pe7TegrOCQI16FImSzPbfEZaufTHE+j1rmbC3r7dMIqs7OEmCUr0mEMO04eh+jdQtIECQQDeV8l/QW0ZefpizGm6PMmyy5EqXsQtAFbHaOkJ8WD/eN6g8Da8dIHhZVP+gh+vatxRVZ1b6natyBooyQqGjvoc",
	"publicKey" => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiGyJvsck/zeDOk3Zx9QlyKJYN1ZnPdlTiVkc/yomKhwoTI/3lckHqBTnRbTzugCnLrcjV1Hb/gRX9opZs/rXLoHoslOsHgkmlyxvcEyIBri/j3bejiJpJfOefM3uxsUlCzj9mc7qZ3ESnssxmeM3Ap/4q/ZByC46yofjBRwtq4QBoFRRJdjMt3/awUoPyddnvkvMsXBKq37tkzzP5tRF73g6hK8U0ASIqEOVM0jec8KMVlx3u4q1Iieq9CH3aiLTfxcReLb2tdgnJaSj+G/u36vk4v+jetGaRKNzSDIQL91EfuT4HMz1wruxOMRVFMYZ4Zz+txA3fRJQJAAXF7cmoQIDAQAB",
	"privateKey" => "MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCIbIm+xyT/N4M6TdnH1CXIolg3Vmc92VOJWRz/KiYqHChMj/eVyQeoFOdFtPO6AKcutyNXUdv+BFf2ilmz+tcugeiyU6weCSaXLG9wTIgGuL+Pdt6OImkl8558ze7GxSULOP2ZzupncRKeyzGZ4zcCn/ir9kHILjrKh+MFHC2rhAGgVFEl2My3f9rBSg/J12e+S8yxcEqrfu2TPM/m1EXveDqErxTQBIioQ5UzSN5zwoxWXHe7irUiJ6r0IfdqItN/FxF4tva12CclpKP4b+7fq+Ti/6N60ZpEo3NIMhAv3UR+5PgczPXCu7E4xFUUxhnhnP63EDd9ElAkABcXtyahAgMBAAECggEBAIA1uPJhR8TOz/ZAadZh6yx2Xf+LpTU8BEUFSboIS5uxoLHrbxwGtLpjAsLA/3kj2fqORJlwphZA0MYzWYBK0mWz0xOcjRohMXJLYWOhmQjwIZ9bcGcVscnn/V9/TdLiPiEg6zzcd/DFFGHFxpTAM9e0rcg2g7X0tG3YbSNFSypvYrB4kcst6dO0y548kHqTIsslQTKx5Fi8asBJqTUiExTiUmFLtB7MNCQICsHBhzLNDbamupX48t9pQooFg7EjnTWAJYYosrFoL9bAmVmEBc8narh7+2jw5t/VDsu6JJV7NBBvRuCLdn6+ELvanWfyVgSzqs1AvzviDSVcW9Frk0ECgYEAuwnaftKHq2NHkdsw35sNBSKV+Yp45S3+yzb206jJIejqEDCbba5QBFxtiByMqJLbylXYG+WBGHn++vBkz5bld5waH0KQfUoRQz4gJjmCRQ6t0bUHggk5LTn4OxEic/oI3nOhnPmltZJWxmNsJdm8C6x2ubYoRpOkUjcE3biY5NkCgYEAurlLGysWfJ5jn2tcnYe2DOBIfwnO+pvPcyNdnemcwtgCfJgxPawOMUY4Uq9t+DhpCAXYAI64C9+q9IHx9ddS/vf+SM9W7Cnfapxt7weIHrDe2AeOe35au4VPMoJY12djT9AJUoSACmqKZwH4iP/T2fLJ9PJLN0P1y6bW0SdTEwkCgYAumhjnqnsFN/pYHB4ESLSox+JIR7kxmRE3/tznBdH/cfIH0KSZYmorfAAKftqJEfZTZqou4TMWLydZzNXBZ16LO8jCaypnHTJJ58vI2mFb5Xlnm8xgGP43B4+S4AUOkojtLDBjVUx1fh3C1njWwXZ6DiGSyhEk7Jpvpae/usPVmQKBgDyhLeIEe6i7RV3eXpRIHLTRnrihVrPJI/Me6Kb91AjwWt5aDKMZ2wHk6yTuEacnqfMQ8rI7pUc1uSzrhMVuxWRE4iyCJpdIgWL8qDWVHH3asIE08u7meE+rWavs5ywKRhUEWAKTQ4AeWBJacXkKmJ+MVkdS5Vlsl8MoyVfgjPkBAoGBAKCh1jgyWqgXx4L+tsMS8yCsUA3/loNy4e5NvNEagQr9ai5l+ggbelTZS4S5/0koj++8svuhqoXDybxzqHyCpOyomPHa4a9Nb/Mdsbtx4VTlwtyHa616SO10VAGgTrxpwJHwPZjs3dn+G5JAfMps4QBFxoOhjqwJiIm3N/WTMsv4"
);

$baiduConfig = array(
	"AppId" => "8293072", 
	"AppKey" => "jVGyasv0GznpyFacKSYKAsE7", 
	"AppSecret" => "2XO4ylhLLrQS2yp3cZZYjhNZyZXRvFDp",
	"NotifyUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/baidu/paycallback.php"
);

$lenovoConfig = array(
	"AppId" => "1606160397944.app.ln", 
	"AppKey" => "MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBANVq8YgiLriuTEuCCVN369+t2CBnI4VijtwQKQS54vCUgznKJVSOULQBMzdahiy7dV06X70kq7QkQBKp9iqE5Fm6sYS2x6bkut8FcIsIPiDctbPc5JEJxlB2rWO9u6l6mZA/GmgBvG8h0sg+SHyFfL93ZqpAg3k9r8DseWXn6i9/AgMBAAECgYAhn3CgBuqfc+5XMwxvFwSVP9k9+aHSAN4K84zSzspfJrap4xwQfz9drJa6EMv0vi/WWTz+GonmnpNtnVNIDZm/840mtetfyftEpMMzkEPNfErhzsQROSWxypJ+KvC7TYCy/ysKHilXFcruEwYP2Utnvu+bSfubVKqEqs9fLnb7KQJBAO4GSNCVBI4NwlTQ4jwL8COT39aizFtrrwV+8O6eKuN5WKmrj3RtFr1OhH2EHtJBu6pMkEN8060wFHJBsdmOh6UCQQDliO/nPK7Zz685C447Q9M/KRDNwQmBIae1W8D/yehB4iUXLhnnjKe7EqLdWfPYSqJZ/6P6bNcyFhEokcGMVVFTAkBHUASy0WK6+K5XYPnXCbCZyC0RDldxsHKQj/a5VxP8cRe6RddGB4T/lK2nOVVOozkJjcTPI2/7/GKz1LDnQIetAkEA2NltJH3NBtPRy8fiAJWMTqBiUrBrZUbBZXIgvMcomI2o0uRn7ryQfgkWOp7P42hnRzVf2qfXCmeUoEpLm2PDJwJAGpUe9nbkV1mpFS3GzeynUvMAFyXN3uQ9X2XJpprhDlc+sSs9iD6V+SunuLcqlDHcI1V0Sr74MuHujeO+xkYbVQ==",
	"WaresId" => "82466",
	"WaresIds" => '{"1":"82441","6":"82433","18":"82434","25":"82430","48":"82435","50":"82431","90":"82432","98":"82436","198":"82437","328":"82438","648":"82439","1998":"82440"}'
);

$meizuConfig = array(
	"AppId" => "3100544", 
	"AppKey" => "197b7795133040a1bf16637c93356b3f", 
	"AppSecret" => "49P5vDBBjx9gOw5dTNAaGqdOq9Q4dMwE",
	"NotifyUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/mz/paycallback.php"
);

$tencentConfig = array(
	"AppId" => "7535010", 
	"AppKey" => "26Gwdek3LzfdPgqifpTervaM", 
	"AppSecret" => "SUNG3K1EZASDLmo2yuUjnKfRh6rQwPxI" 
);

$pptvConfig = array(
	"GId" => "wsdld_m",
	"PayKey" => "abc5464751b4ef1b3e5f2b82aba083d8"
);

$pywConfig = array(
	"GameKey" => "f8907fab",
	"PayKey" => "489d385efaa5303e"
);

$haimaAndroidConfig = array(
	"AppId" => "6437f0a45be212f93e61a70d5f21c939",
	"AppKey" => "50aedefa1fb30190ad9ad53b9b053636"
);

$haimaIOSConfig = array(
	"AppId" => "55c1dc57a389c47feb6ba201c2642560",
	"AppKey" => "75f810e7eb6c53b1f3f60fa74c58d631"
);

$niuxConfig = array(
	"GameId" => "050417",
	"AppKey" => "HsukE4Ped2BU3qHDq4pbfb6n03llrHvh",
	"PayKey" => "EDuixvYLEPctv8czz3iFTdW8",
	"PayCheckUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/niux/paycallbackcheck.php" 
);

$Ju8868Config = array(
	"GameId" => "2864",
	"CpId" => "8949",
	"AppKey" => "67E37681C491E80E38A44A6E547F370F"
);

$KY7659Config = array(
	"PayId" => "104062",
	"AppKey" => "32a53964dd821936cbbb8e2ec5fedd9f",
	"PublicKey" => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCnc9aE3abdC+wbxom4udFygACX7nzbvCotqc0huiUvcVfT7gdmGV0Bz4KCoOu75lhhpHyFfmvnpwPzX7dgROZNEhFWC6uo2pBqD/m2GNC8l5v7URRdcUpxjKJLTBHL0CJTi9XiQtfF/4JfKfJUvXe2ArdSO/GeQ/Wj56sAODKGywIDAQAB",
	"PrivateKey" => "e1666399379c0edb3b906c70d2893079"
);

$XYConfig = array(
	"AppId" => "100030366",
	"AppKey" => "5BzOiTwzsKNXLW5fns8ccxoAwhHAcw55",
	"PayKey" => "EYCwNoWgDcideAoSzwju2akKu8edsR38"
);

$YxdConfig = array(
	"AppId" => "HC9pLdJDmVux",
	"PublicKey" => "MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAMjVg79fpECYVodvEONRVc1R+g4DkteKiJI6PFMutDSM/EPKMxkOvBVscYKOLmtA5lQ7cCEwB++ZdwVEx1pGWHkCAwEAAQ==",
	"PrivateKey" => "MIIBVQIBADANBgkqhkiG9w0BAQEFAASCAT8wggE7AgEAAkEAyNWDv1+kQJhWh28Q41FVzVH6DgOS14qIkjo8Uy60NIz8Q8ozGQ68FWxxgo4ua0DmVDtwITAH75l3BUTHWkZYeQIDAQABAkEAupviWgzlUvv50sf5mi62Ghykyya457waYDzqVqRb30LHZZJaF03LJ9xjZ0hDBT83JepO9IjwLGwvvaon3NIODQIhAOu/SvqeAdARfHU4Q1eq49hVKv+TM5zMpoDyBOt/ukHPAiEA2hZjUPDUO9zTY5qVy05dIPFqj3mzzgU/ILqrFS3QuzcCIF9V6bV2BpelKqagzSL72c5Xit72IW4smL0WooS2D5WjAiEAx9QPuJCSxy81+mQgsSLirlbGvyRSnomsKD8il8tdIM0CIHWv97C0VXnnV9GfDwdWysDNO49KAayYAjCgkZMxTQ0E",
	"AppKey" => "MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAJXJVHxjMMGV9FXFqBDya2aiZ1mAnHGJZQsaWTId3ulw2aTfFJvuFw2vxA0maiae9ZacAEYVxIX7+gQ5lsb95PUCAwEAAQ=="
);

$TTConfig = array(
	"GameId" => "201611019",
	"ApiKey" => "2e5ca6143adccd329aa08a9e7825d3f9",
	"PayKey" => "984e597168f166093abb47d2da5316ac",
	"NotifyUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/tt/paycallback.php",
);

$YeShenConfig = array(
	"AppId" => "2f7fa422d75c4a72b5c8e1f1dcb774d2",
	"AppKey" => "98c97515a538460eb07a5d85d8429e18",
	"NotifyUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/yeshen/paycallback.php",
);

$TsyConfig = array(
	"AppId" => "c6655822de6c3400de57c287",
	"AppSecret" => "41433ac3a15158da80d520852b111cd2d6df4314",
	"NotifyUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/tsy/paycallback.php",
);

$PaPaConfig = array(
	"AppKey" => "16000549",
	"PrivateKey" => "ce6e135ac1ac7f4a",
	"SecretKey" => "6402afd677d6641975ca0874f7dc0da226e73d66bbf0bf8a06fecf93f148ca86",
	"NotifyUrl" => "http://" . SERVER1 . "/wushuang/server/transaction/papa/paycallback.php",
);

$Platform = array(
	"Browser" => array(
		"PlatformId" => 0, 
		"PlatformName" => "浏览器", 
		"OS" => "Browser", 
		"ClientVersion" => 100, 
		"Register" => true, 
		"PluginLogin" => "", 
		"PluginPay" => "", 
		"Config" => "", 
		"Coin" => "元" 
	), 
	"AlipayAndroid" => array(
		"PlatformId" => 1, 
		"PlatformName" => "安卓默认", 
		"OS" => "Android", 
		"ClientVersion" => 101, 
		"Register" => true, 
		"PluginLogin" => "", 
		// "PluginPay" => "IAPAlipay", 
		"Config" => $alipayConfig, 
		"Coin" => "元" 
	), 
	"AlipayIOS" => array(
		"PlatformId" => 2, 
		"PlatformName" => "苹果默认", 
		"OS" => "IOS", 
		"ClientVersion" => 100, 
		"Register" => true, 
		"PluginLogin" => "", 
		"PluginPay" => "", 
		"Config" => $alipayConfig, 
		"Coin" => "元" 
	), 
	"ND91Android" => array(
		"PlatformId" => 3, 
		"PlatformName" => "91安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserNd91", 
		"PluginSocial" => "SocialNd91", 
		"PluginPay" => "IAPNd91", 
		"Config" => $nd91Config, 
		"Coin" => "个91豆" 
	), 
	"ND91IOS" => array(
		"PlatformId" => 4, 
		"PlatformName" => "91苹果", 
		"OS" => "IOS", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserNd91", 
		"PluginSocial" => "SocialNd91", 
		"PluginPay" => "IAPNd91", 
		"Config" => $nd91IOSConfig, 
		"Coin" => "个91豆" 
	), 
	"QH360Android" => array(
		"PlatformId" => 5, 
		"PlatformName" => "360安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserQH360", 
		"PluginPay" => "IAPQH360", 
		"Config" => $qh360Config, 
		"Coin" => "元" 
	), 
	"QH360IOS" => array(
		"PlatformId" => 6, 
		"PlatformName" => "360苹果", 
		"OS" => "IOS", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserQH360", 
		"PluginPay" => "IAPQH360", 
		"Config" => $qh360Config, 
		"Coin" => "元" 
	),
	"XiaomiAndroid" => array(
		"PlatformId" => 7, 
		"PlatformName" => "小米安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserXiaomi", 
		"PluginPay" => "IAPXiaomi", 
		"Config" => $xiaomiConfig, 
		"Coin" => "元" 
	), 
	"PPAndroid" => array(
		"PlatformId" => 9, 
		"PlatformName" => "PP安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserNd91", 
		"PluginPay" => "IAPNd91", 
		"Config" => array(), 
		"PayGoBack" => true, 
		"Coin" => "PP币" 
	), 
	"PPIOS" => array(
		"PlatformId" => 10, 
		"PlatformName" => "PP苹果", 
		"OS" => "IOS", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserPP", 
		"PluginPay" => "IAPPP", 
		"Config" => $ppConfig, 
		"PayGoBack" => true, 
		"Coin" => "PP币" 
	), 
	"QQAndroid" => array(
		"PlatformId" => 11, 
		"PlatformName" => "腾讯安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => true, 
		"PluginLogin" => "", 
		"PluginPay" => "IAPAlipay", 
		"Config" => $alipayConfig, 
		"Coin" => "元" 
	), 
	"QQBroswer" => array(
		"PlatformId" => 12, 
		"PlatformName" => "腾讯浏览器", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"Runtime" => true, 
		"PluginLogin" => "", 
		"PluginPay" => "", 
		"Config" => array(), 
		"Coin" => "元" 
	), 
	"BaiduBroswer" => array(
		"PlatformId" => 13, 
		"PlatformName" => "百度浏览器", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false,  
		"Runtime" => true, 
		"PluginLogin" => "", 
		"PluginPay" => "", 
		"Config" => array(), 
		"Coin" => "元" 
	), 
	"DMAndroid" => array(
		"PlatformId" => 14, 
		"PlatformName" => "多盟安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => true, 
		"PluginLogin" => "", 
		"PluginPay" => "IAPAlipay", 
		"Config" => $alipayConfig, 
		"Coin" => "元" 
	), 
	"37937Android" => array(
		"PlatformId" => 15, 
		"PlatformName" => "37937安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => true, 
		"PluginLogin" => "", 
		"PluginPay" => "IAPAlipay", 
		"Config" => $alipayConfig, 
		"Coin" => "元" 
	), 
	"UCAndroid" => array(
		"PlatformId" => 16, 
		"PlatformName" => "UC安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserUC", 
		"PluginPay" => "IAPUC", 
		"PluginSocial" => "", 
		"PluginAds" => "AdsUC", 
		"Config" => $ucConfig, 
		"Coin" => "元" 
	), 
	"UCIOS" => array(
		"PlatformId" => 17, 
		"PlatformName" => "UC苹果", 
		"OS" => "IOS", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserUC", 
		"PluginPay" => "IAPUC", 
		"PluginSocial" => "SocialUC", 
		"Config" => $ucConfig, 
		"Coin" => "元" 
	), 
	"TBIOS" => array(
		"PlatformId" => 18, 
		"PlatformName" => "同步推苹果", 
		"OS" => "IOS", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserTB", 
		"PluginPay" => "IAPTB", 
		"Config" => $tbConfig, 
		"Coin" => "元" 
	), 
	"AppleIOS" => array(
		"PlatformId" => 19, 
		"PlatformName" => "苹果官方", 
		"OS" => "IOS", 
		"ClientVersion" => 100, 
		"Register" => true, 
		"PluginLogin" => "", 
		"PluginPay" => "IAPApple", 
		"Config" => $appleConfig, 
		"Coin" => "元" 
	), 
	"BaiduAndroid" => array(
		"PlatformId" => 20, 
		"PlatformName" => "百度安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserBaidu", 
		"PluginPay" => "IAPBaidu", 
		"PluginSocial" => "", 
		"Config" => $baiduConfig, 
		"Coin" => "元" 
	), 
	"AnzhiAndroid" => array(
		"PlatformId" => 21, 
		"PlatformName" => "安智安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => true, 
		"PluginLogin" => "", 
		"PluginPay" => "IAPAlipay", 
		"Config" => $alipayConfig, 
		"Coin" => "元" 
	), 
	"AnfengAndroid" => array(
		"PlatformId" => 22, 
		"PlatformName" => "安锋安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => true, 
		"PluginLogin" => "", 
		"PluginPay" => "IAPAlipay", 
		"Config" => $alipayConfig, 
		"Coin" => "元" 
	), 
	"MumayiAndroid" => array(
		"PlatformId" => 23, 
		"PlatformName" => "木蚂蚁安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => true, 
		"PluginLogin" => "", 
		"PluginPay" => "IAPAlipay", 
		"Config" => $alipayConfig, 
		"Coin" => "元" 
	), 
	"WandoujiaAndroid" => array(
		"PlatformId" => 24, 
		"PlatformName" => "豌豆荚安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => true, 
		"PluginLogin" => "", 
		"PluginPay" => "IAPAlipay", 
		"Config" => $alipayConfig, 
		"Coin" => "元" 
	), 
	"HiapkAndroid" => array(
		"PlatformId" => 25, 
		"PlatformName" => "安卓市场", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => true, 
		"PluginLogin" => "", 
		"PluginPay" => "IAPAlipay", 
		"Config" => $alipayConfig, 
		"Coin" => "元" 
	), 
	"NduoAndroid" => array(
		"PlatformId" => 26, 
		"PlatformName" => "N多市场", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => true, 
		"PluginLogin" => "", 
		"PluginPay" => "IAPAlipay", 
		"Config" => $alipayConfig, 
		"Coin" => "元" 
	), 
	"BrowserTW" => array(
		"PlatformId" => 28, 
		"PlatformName" => "浏览器台湾", 
		"OS" => "Browser", 
		"ClientVersion" => 100, 
		"Register" => true, 
		"PluginLogin" => "", 
		"PluginPay" => "", 
		"Config" => array(), 
		"Coin" => "元" 
	), 
	"DownjoyAndroid" => array(
		"PlatformId" => 29, 
		"PlatformName" => "当乐安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => true, 
		"PluginLogin" => "", 
		"PluginPay" => "IAPAlipay", 
		"Config" => $alipayConfig, 
		"Coin" => "元" 
	), 
	"SandBoxAndroid" => array(
		"PlatformId" => 30, 
		"PlatformName" => "沙盒安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => true, 
		"PluginLogin" => "", 
		"PluginPay" => "IAPAlipay", 
		"Config" => $alipayConfig, 
		"Coin" => "元" 
	), 
	"OpooAndroid" => array(
		"PlatformId" => 31, 
		"PlatformName" => "OPPO安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserOppo", 
		"PluginPay" => "IAPOppo", 
		"PluginSocial" => "", 
		"Config" => $oppoConfig, 
		"Coin" => "可币" 
	), 
	"VivoAndroid" => array(
		"PlatformId" => 32, 
		"PlatformName" => "VIVO安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserVivo", 
		"PluginPay" => "IAPVivo", 
		"PluginSocial" => "", 
		"PluginAds" => "AdsVivo", 
		"Config" => $vivoConfig, 
		"Coin" => "元" 
	), 
	"AmigoAndroid" => array(
		"PlatformId" => 33, 
		"PlatformName" => "金立安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserAmigo", 
		"PluginPay" => "IAPAmigo",
		"Config" => $amigoConfig, 
		"Coin" => "元" 
	), 
	"CoolpadAndroid" => array(
		"PlatformId" => 34, 
		"PlatformName" => "酷派安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserCoolpad", 
		"PluginSocial" => "", 
		"PluginPay" => "IAPCoolpad", 
		"Config" => $coolpadConfig, 
		"Coin" => "元" 
	), 
	"HuaweiAndroid" => array(
		"PlatformId" => 35, 
		"PlatformName" => "华为安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserHuawei", 
		"PluginAds" => "AdsHuawei", 
		"PluginPay" => "IAPHuawei", 
		"Config" => $huaweiConfig, 
		"Coin" => "元" 
	), 
	"LenovoAndroid" => array(
		"PlatformId" => 36, 
		"PlatformName" => "联想安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserLenovo", 
		"PluginPay" => "IAPLenovo", 
		"Config" => $lenovoConfig, 
		"Coin" => "元" 
	), 
	"MeizuAndroid" => array(
		"PlatformId" => 37, 
		"PlatformName" => "魅族安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserMeizu", 
		"PluginPay" => "IAPMeizu", 
		"Config" => $meizuConfig, 
		"Coin" => "元" 
	),
	"TencentAndroid" => array(
		"PlatformId" => 38, 
		"PlatformName" => "腾讯应用宝安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserTencent", 
		"PluginPay" => "IAPTencent", 
		"Config" => $tencentConfig, 
		"Coin" => "元" 
	),
	"PPTVAndroid" => array(
		"PlatformId" => 39, 
		"PlatformName" => "PPTV安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserPPTV", 
		"PluginPay" => "IAPPPTV", 
		"PluginAds" => "AdsPPTV", 
		"Config" => $pptvConfig, 
		"Coin" => "元" 
	),
	"PYWAndroid" => array(
		"PlatformId" => 40, 
		"PlatformName" => "朋友玩安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserPYW", 
		"PluginPay" => "IAPPYW", 
		"Config" => $pywConfig, 
		"Coin" => "元" 
	),
	"HaimaAndroid" => array(
		"PlatformId" => 41, 
		"PlatformName" => "海马安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserHaima", 
		"PluginPay" => "IAPHaima", 
		"Config" => $haimaAndroidConfig, 
		"Coin" => "元" 
	),
	"NiuxAndroid" => array(
		"PlatformId" => 42, 
		"PlatformName" => "迅雷牛X安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserNiux", 
		"PluginPay" => "IAPNiux", 
		"PluginAds" => "AdsNiux", 
		"Config" => $niuxConfig, 
		"Coin" => "元" 
	),
	"Ju8868Android" => array(
		"PlatformId" => 43, 
		"PlatformName" => "8868安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "User8868", 
		"PluginPay" => "IAP8868", 
		"Config" => $Ju8868Config, 
		"Coin" => "元" 
	),
	"KY7659IOS" => array(
		"PlatformId" => 44, 
		"PlatformName" => "7659苹果", 
		"OS" => "IOS", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "User7659", 
		"PluginPay" => "IAP7659", 
		"Config" => $KY7659Config, 
		"Coin" => "元" 
	),
	"HaimaIOS" => array(
		"PlatformId" => 45, 
		"PlatformName" => "海马苹果", 
		"OS" => "IOS", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserHaima", 
		"PluginPay" => "IAPHaima", 
		"Config" => $haimaIOSConfig, 
		"Coin" => "元" 
	),
	"XYIOS" => array(
		"PlatformId" => 46, 
		"PlatformName" => "XY苹果", 
		"OS" => "IOS", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserXY", 
		"PluginPay" => "IAPXY", 
		"Config" => $XYConfig, 
		"Coin" => "元" 
	),
	"YxdAndroid" => array(
		"PlatformId" => 47, 
		"PlatformName" => "多游安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserYxd", 
		"PluginPay" => "IAPYxd", 
		"Config" => $YxdConfig, 
		"Coin" => "元" 
	),
	"TBAndroid" => array(
		"PlatformId" => 48, 
		"PlatformName" => "同步推安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserTB", 
		"PluginPay" => "IAPTB", 
		"Config" => $tbAndroidConfig, 
		"Coin" => "元" 
	), 
	"TTAndroid" => array(
		"PlatformId" => 49, 
		"PlatformName" => "TT安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserTT", 
		"PluginPay" => "IAPTT", 
		"Config" => $TTConfig, 
		"Coin" => "元" 
	), 
	"YeShenAndroid" => array(
		"PlatformId" => 50, 
		"PlatformName" => "夜神安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserYeShen", 
		"PluginPay" => "IAPYeShen", 
		"Config" => $YeShenConfig, 
		"Coin" => "元" 
	), 
	"TsyAndroid" => array(
		"PlatformId" => 51, 
		"PlatformName" => "淘手游安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserTsy", 
		"PluginPay" => "IAPTsy", 
		"PluginAds" => "AdsTsy", 
		"Config" => $TsyConfig, 
		"Coin" => "元" 
	), 
	"PaPaAndroid" => array(
		"PlatformId" => 52, 
		"PlatformName" => "啪啪游戏厅安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => false, 
		"PluginLogin" => "UserPaPa", 
		"PluginPay" => "IAPPaPa", 
		"PluginAds" => "AdsPaPa", 
		"Config" => $PaPaConfig, 
		"Coin" => "元" 
	), 
	"GoogleAndroid" => array(
		"PlatformId" => 53, 
		"PlatformName" => "google安卓", 
		"OS" => "Android", 
		"ClientVersion" => 100, 
		"Register" => true, 
		"PluginPay" => "IAPGoogle", 
		"Config" => $googleConfig, 
		"Coin" => "元" 
	), 
);

function GetPlatformList($platfromId = false)
{
	global $Platform;
	if($platfromId == false && $platfromId != 0)
	{
		return $Platform;
	}
	foreach($Platform as $k => $data)
	{
		if($data["PlatformId"] == $platfromId)
		{
			return $data;
		}
	}
	return null;
}

function GetPlatform($platfromId, $key = false)
{
	global $Platform;
	foreach($Platform as $k => $data)
	{
		if($data["PlatformId"] == $platfromId)
		{
			if($key)
			{
				return $k;
			}
			else
			{
				return $data;
			}
		}
	}
	return null;
}

function GetPlatformKeyName($platfromId)
{
	return GetPlatform($platfromId, true);
}

function GetPlatformClientVersion($platfromId)
{
	return GetPlatform($platfromId)["ClientVersion"];
}

function GetPlatformName($platfromId)
{
	return GetPlatform($platfromId)["PlatformName"];
}

function GetPlatformOS($platfromId)
{
	return GetPlatform($platfromId)["OS"];
}

function GetPlatformRegister($platfromId)
{
	return GetPlatform($platfromId)["Register"];
}

function GetPlatformCoin($platfromId)
{
	$platform = GetPlatform($platfromId);
	if(array_key_exists("Coin", $platform))
	{
		return $platform["Coin"];
	}
	return null;
}

?>
