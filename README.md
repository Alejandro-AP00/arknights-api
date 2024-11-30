# Arknights Backend

This is an opinionated implementation of the Arknights JSON files as a REST Api
For the locale choose one of the following `en_US`, `ko_KR`, `zh_CN`, `ja_JP` locales to get the data in the right language.

### Endpoints

- `/{locale}/operators`
- `/{locale}/operators/{char_id}`
- `/{locale}/operators/{char_id}/all` 
- `/{locale}/operators/{char_id}/skills` 
- `/{locale}/operators/{char_id}/skills/{skill_id}`
- `/{locale}/operators/{char_id}/modules`
- `/{locale}/operators/{char_id}/modules/{module_id}`
- `/{locale}/operators/{char_id}/talents` 
- `/{locale}/operators/{char_id}/handbook` 
- `/{locale}/operators/{char_id}/skins` 
- `/{locale}/operators/{char_id}/voices` 
- `/{locale}/operators/{char_id}/riic` 
- `/{locale}/operators/{char_id}/summons` 
- `/{locale}/operators/{char_id}/summons/{char_id}` 
- `/{locale}/operators/{char_id}/alters` 
- `/ranges` 
- `/ranges/{range_id}` 

## Typescript Definitions

This project includes typescript definitions for all the data that comes back in the endpoints. You can find the `.d.ts` file in `/resources/types/generated.d.ts` You are free to copy this file into your own projects.

## This project wouldn't be possible without

- [Kengxxiao](https://github.com/Kengxxiao) ([ArknightsGameData](https://github.com/Kengxxiao/ArknightsGameData), [ArknightsGameData_YoStar](https://github.com/Kengxxiao/ArknightsGameData_YoStar))

## TODO
- [x] Add Missing Endpoints
- [ ] Add Correct Scheduler to autoupdate data
- [ ] Add Items
- [ ] Add filters for Operator Listing endpoints
- [ ] Add Levels Endpoints
- [ ] Convert Profession and Subprofession from characters into Models
- [ ] Add Search Capabilities with Laravel Scout
- [ ] Attach image urls from https://github.com/SanityGoneAK/arknights-images
- [ ] Add String Macro for converting game strings to html
