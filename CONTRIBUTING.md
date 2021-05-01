# Contributing

Thanks for using this packages and thinking about contributing.

In order to keep a code clean and organized follow these steps to contribute:

## PR :arrow_down:
- Fork the repo and develop your feature on a **dedicated branch**. Then open a PR from your branch to this project main branch.
- Keep **PR small** and in the appropriate context. Do not mix changes: if you have more than one contribution (eg a fix and a feat or 2 different features) you must open 2 PR.
  This way the review can be focused on each feature.
- The merge strategy will be "squash" in order to keep a clean history on the main branch.

## Test :hammer:
- Add **tests**: is important to ensure that tests always pass. All your new feature should be tested and if you change existing feature you should ensure that tests are not broken (and if yes you must fix them).

## Documentation :page_facing_up:
- Update **README**: documentation must always be kept updated.
- Update **CHANGELOG**: Changelog adheres to "keep a changelog" format and "semantic versioning".

## Code style :art:
- Rules are already defined. You should run `./vendor/bin/php-cs-fixer fix` in order to format your code before pushing.
