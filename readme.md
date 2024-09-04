# PHP Comment Checker Pre-commit Hook

This project is a Git pre-commit hook that checks if PHP files contain appropriate comments immediately after the `<?php` tag. It ensures that your code is well-documented before being committed to your repository.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [How It Works](#how-it-works)
- [Customization](#customization)
- [Contributing](#contributing)
- [License](#license)

## Features

- **Automated Comment Checking:** Ensures PHP files have comments right after the `<?php` tag.
- **Multi-threaded Processing:** Uses threading to read multiple files concurrently for efficiency.
- **Singleton Implementation:** Ensures that classes like Shell and ErrorHandler have a single instance.
- **Error Handling:** Captures and manages errors during file reading and processing.
- **Supports Multiple File Types:** Can be extended to support other file types or additional checks.

## Requirements

- Python 3.x
- Git

## Installation

1. **Clone the repository:**
   ```bash
   git clone <repository-url>
   ```

2. **Navigate to the project directory:**
   ```bash
   cd <project-directory>
   ```

3. **Install the pre-commit hook:**
   Copy the pre-commit script to your `.git/hooks` directory.
   ```bash
   cp pre-commit .git/hooks/
   chmod +x .git/hooks/pre-commit
   ```

## Usage

After installing the pre-commit hook, it will automatically run every time you attempt to commit code to the repository. If the PHP files being committed do not have the required comments, the commit will be blocked, and an error message will be displayed.

To commit your changes:
```bash
git add .
git commit -m "Your commit message"
```

If the hook detects any issues, it will output the results in the terminal, and you'll need to fix the issues before committing again.

## How It Works

1. **File Detection:** The script identifies files that are staged for commit using `git diff --cached`.
2. **File Filtering:** It filters out non-PHP files.
3. **Comment Checking:** For each PHP file, it checks if there is a comment immediately following the `<?php` tag.
4. **Error Reporting:** If any file is missing the required comments, it reports the issue and prevents the commit.

### Key Classes and Functions

- **Shell Class:** Handles colored output for messages.
- **ErrorHandler Class:** Manages errors encountered during file processing.
- **File Class and Subclasses:** Represents different PHP file types like `Class`, `Trait`, `Enum`, `Interface` and handles the comment checking.
- **ReturnableThread Class:** A thread class that returns results after execution, enabling multi-threaded file processing.

## Customization

You can extend the hook to perform additional checks or support other file types by modifying or adding new classes and regular expressions in the `File` class and its subclasses.

For instance, to add new checks for PHP methods or attributes, update the regular expressions in the `Method` and `Attribute` classes.
