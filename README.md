# Questions API

## How to run

1. Make sure you have the Symfony CLI installed
2. Install the dependencies using composer
3. Run: `symfony server:start`

## How to use CSV or JSON data

1. Open file `config/services.yaml`
2. Replace line 35 with any of these:

```
App\Repository\QuestionsRepository: '@App\Repository\CsvQuestionsRepository'
App\Repository\QuestionsRepository: '@App\Repository\JsonQuestionsRepository'
```
