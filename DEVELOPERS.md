# Developemnt rules

Version 5.5 is a complete rewrite to get rid of years of patches
made without a clear global picture, make the code more robust and
future improvements easier.

## Goals

- Smart use of classes and autoload
- Smart use of composer packages, only code parts that are specific
  to this project, use well-known libraries when available.
- Maintain a clear separation between
    - data
        - permanent data (generated data, needed to display the generated pages)
        - temporary data (uploaded files, cache, ffmpeg temporary files, reporting, etc.)
    - data processing (directory scan, video conversion, thumbnails generation, ...)
    - web interface (generating pages will rely on data processing)
    - layout (themes and templates, used to generate pages and allow per site/per project customization)
    - command-line tools (will rely on data processing)
    - compatibility layer (everything needed only to maintain backswards compatibility
      for methods and functionalties replaced in the new version)

Old code is in legacy/ folder. New code is organized in folders based on their respective
layer.

HTML generated with bootstrap classes, with as less css or javascript as possible, to allow 
easy theming. The project itselfs makes no fancy HTML, it only makes sure generated 
pages are omptimized for responsive layout and theme customization.

This transition will take time, so it is critical to maintain backwards compatibility,
to allow progressive updates, benefiting of new features while still relying on old 
ones and fix potential bugs in the old code.

## Coding rules

- Make it short, clear and concise
- Always favor classes,  methods and functions provided by the framework
- Avoid creating complex routines if a library is available to get a
  similare result
- If a variable, constant or function is only used once, it is probably
  not necessary
- If the same routine is used twice or more, it probably requires a
  function or method
- If the same value is used twice or more, it probably requires a variable
  or property
- Never include inline scripts or css in html. Scripts and styles are
  saved in separated files, main files for general use, or specific files for parts needed only in specific situations
- Never include direct styling classes in html and templates, use business
  classes, favor standard business classes provided by the framework
- Never include direct links to css and js in generated code, use standard
  Laravel/Livewire/Filament methods

## Code style

- English for all code, comments, and documentation.
- Prefer simple, well-tested constructs. Avoid global mutable state.
- Reuse existing libraries and patterns already in the project.
- Small, focused unit tests for new logic.

## Commit message format

```
(scope) short subject

- detail
- detail

Optional additional context.
```

- **scope**: area of the change — e.g. `(api)`, `(lsl)`, `(build)`, `(tests)`, `(doc)`, `(config)`
- **subject**: imperative, lowercase, no trailing period
- **details**: bullet list with `-`, one item per logical change
- Omit details for trivial single-change commits
- Prefix with `(untested)` when the change has not been verified yet; reword after a successful test

## Version releases

```
v1.2.3 Main change if applicable
- new ...
- new ...
- fix ...
- update ...
```

- **subject** first line begins exactly with "v" + the version number to allow automated workflows and maintenance scripts. An option description of the main change might be added if relevant
- **details** a list of the main changes since the previous version release commit
- create a version release only when the version is fully tested and approved: bumping the version number in files does not mean the version must be released yet
- Be concise, full explanation can be found in git history
- Omit small patches and fixes, focus on essential features
- Make sure to update all relevant files (.version, README.md, composer.json... ) and update CHANGELOG.md with the exact same description
- after commit, add a tag with "v1.2.3" (version number) as tag name and the exact same message as commit
