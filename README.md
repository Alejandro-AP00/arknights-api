# Arknights Backend

This is an opinionated implementation of the Arknights JSON files as a REST Api, it includes endpoints for:

- `/operators`
- `/operators/{char_id}`
- `/operators/{char_id}/all` 
- `/operators/{char_id}/skills` 
- `/operators/{char_id}/skills/{skill_id}`
- `/operators/{char_id}/modules`
- `/operators/{char_id}/modules/{module_id}`
- `/operators/{char_id}/talents` 
- `/operators/{char_id}/handbook` 
- `/operators/{char_id}/skins` 
- `/operators/{char_id}/voices` 
- `/operators/{char_id}/riic` 
- `/operators/{char_id}/summons` 
- `/operators/{char_id}/summons/{char_id}` 
- `/operators/{char_id}/alters` 
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
