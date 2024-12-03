# Arknights Backend

This is an opinionated implementation of the Arknights JSON files as a REST Api
For the locale choose one of the following `en_US`, `ko_KR`, `zh_CN`, `ja_JP` locales to get the data in the right language.

### Endpoints

- `/{locale}/operators`
- `/{locale}/operators/{char_id}`
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

When using these endpoints you can query anything you need

- `/{locale}/operators`
- `/{locale}/operators/{char_id}`


#### Query Parameters

##### Filters
You can filter characters using the following fields:

| Parameter       | Description                        | Example                                  |
|-----------------|------------------------------------|------------------------------------------|
| `name`          | Filter by character name.         | `?filter[name]=Amiya`                   |
| `profession`    | Filter by profession.             | `?filter[profession]=Medic`             |
| `sub_profession`| Filter by sub-profession.         | `?filter[sub_profession]=Healing`       |
| `nation`        | Filter by character's nation.     | `?filter[nation]=Rhodes Island`         |
| `position`      | Filter by position (e.g., Melee). | `?filter[position]=Melee`               |
| `rarity`        | Filter by rarity level.           | `?filter[rarity]=6`                     |
| `is_limited`    | Filter by whether limited.        | `?filter[is_limited]=true`              |

##### Sorting
Sort the results by any of the following fields. Use a minus (`-`) prefix for descending order.

| Field           | Example                 |
|-----------------|-------------------------|
| `name`          | `?sort=name`           |
| `profession`    | `?sort=-profession`    |
| `sub_profession`| `?sort=sub_profession` |
| `nation`        | `?sort=nation`         |
| `position`      | `?sort=position`       |
| `rarity`        | `?sort=-rarity`        |
| `released_at`   | `?sort=released_at`    |

##### Includes
You can include related data by specifying them in the `include` parameter. Use dot notation to access nested relationships.

###### Available Includes
- `phases`
- `potentialRanks`
- `traitCandidates`
- `handbook`
- `modules.stages.upgrades.candidates`
- `modules.unlockMissions`
- `riccSkills`
- `skills.levels`
- `skins`
- `talents`
- `voices`
- `alterCharacters`
- `baseCharacter`
- `summons`

###### Example
To include `phases` and `skills.levels`:
```
?include=phases,skills.levels
```

###### Nested Includes
You can include nested relationships using prefixes:
- `alterCharacters.phases`
- `baseCharacter.skills.levels`
- `summons.talents`

#### Notes
- The default behavior (DYNAMIC) applies when no explicit operator is provided, as shown in `?filter[rarity]=6`.

#### Examples
- Filter characters with rarity greater than or equal to 5:
  ```
  ?filter[rarity][>=]=5
  ```
- Filter characters not from a specific nation:
  ```
  ?filter[nation][<>]=Ursus
  ```

--- 

Let me know if you'd like further refinements!

## Typescript Definitions

This project includes typescript definitions for all the data that comes back in the endpoints. You can find the `.d.ts` file in `/resources/types/generated.d.ts` You are free to copy this file into your own projects.

## This project wouldn't be possible without

- [Kengxxiao](https://github.com/Kengxxiao) ([ArknightsGameData](https://github.com/Kengxxiao/ArknightsGameData), [ArknightsGameData_YoStar](https://github.com/Kengxxiao/ArknightsGameData_YoStar))

## TODO
- [x] Add Missing Endpoints
- [x] Add Correct Scheduler to autoupdate data
- [ ] Add Items
- [x] Add filters for Operator Listing endpoints
- [ ] Add Levels Endpoints
- [ ] Convert Profession and Subprofession from characters into Models
- [ ] Add Search Capabilities with Laravel Scout
- [ ] Attach image urls from https://github.com/SanityGoneAK/arknights-images
- [ ] Add String Macro for converting game strings to html
