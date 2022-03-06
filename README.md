# yaml-diff-extrator
YAML diff extraction

## Usage
```php
# Default depth limit to output inline.
YamlDiffExtractor::DEFAULT_INLINE_FROM = 16;

$diff = YamlDiffExtractor::extractFiles(
    __DIR__ . '/one.yaml', // File One
    __DIR__ . '/two.yaml', // File Two
    __DIR__ . '/diff.yaml' // Diff file destination
);

var_dump($diff);
```

Example:
```yaml
# One
message:
  equals: "This is a message"
  not_equals: "This is a message with changes"

# Two
message:
  equals: "This is a message"
  not_equals: "This is a message"

# Diff
message:
  not_equals: 'This is a message'
```
