# 考试报名

[![circle ci](https://circleci.com/gh/swumao/exam-enroll.svg?style=shield&circle-token=225c588b53c9fca13d451b7a2c4ef94bea2fc498)](https://circleci.com/gh/swumao/exam-enroll)

现阶段还在开发，部署完成之后可以使用以下功能：

- 上传excel文件并根据配置返回数组格式的文件。

## Install
```bash
git clone https://github.com/swumao/exam-enroll.git
cd exam-enroll
composer install # 如果没有安装composer需要先安装
# 然后配置apache虚拟主机，web根目录指向exam-enroll/web/htdocs
# Congratulation!
```

## Usage

### By browser

1. 访问http://your-domain.com/index.php/import/student_account
2. 在表单中选择文件上传即可看到解析结果。

### By api

1. 发送POST请求到http://your-domain.com/api.php/import/student_account 注意要上传文件，键名为`student_account_file`
2. 即可收到结果。

### Do it yourself

- Configure your rules in file `/src/Config/import_excel.json`
- Use `\Kezhi\Common\Upload` class to handle your upload.
- Use `\Kezhi\Lib\ExcelImport` class to handle your excel.
- See example in file `/src/Controller/Import.php` & `/src/Api/Import.php`

## Configure format

```json
    "import_excel" : {
        "exts" : {
            "xls" : true,
            "xlsx" : true
        },
        "rules" : {
            "import_user_account" : {
                "rules" : {
                    "id" : "A",
                    "student_number" : "B",
                    "name" : "C",
                    "sex" : "D",
                    "nation" : "E",
                    "id_card_number" : "F",
                    "telephone_number" : "G",
                    "college" : "H",
                    "grade" : "I",
                    "major" : "J",
                    "class" : "K"
                },
                "exts" : {
                    "xls" : true //这里的配置将会覆盖上面的配置
                }
            },
            "import_payment_condition" : {
                "rules" : {
                    "id" : "A",
                    "student_number" : "B",
                    "name" : "C",
                    "sex" : "D",
                    "nation" : "E",
                    "id_card_number" : "F",
                    "telephone_number" : "G",
                    "college" : "H",
                    "grade" : "I",
                    "major" : "J",
                    "class" : "K",
                    "chalk" : "L",
                    "pen" : "M",
                    "writing_brush" : "N"
                }
            }
        }
    }
}

```
