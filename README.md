# WordPress Boilerplate
This is a boilerplate for WordPress projects. It includes a Docker setup for local development and a custom theme that supports Full Site Editing out of the box.

## Requirements
- Docker
- DDEV

## Setup
1. In github click use this template to create a fork from this template repository.
2. Clone the repository to your local machine
3. Configure the site name using DDEV config `ddev config --project-name=<new_name>`
4. Run `ddev start` to start the development environment.
5. `ddev ssh` into the container, run `composer run setup` and follow the prompts to complete the site setup.

## Theme
The theme is built with full site editing in mind and has some quality of life features to assist in development. These are documented below:

### Core Folder
The theme contains a core folder which contains some helper functions and more of the inner workings of this. That folder should be left alone as it is managed with composer. It includes functionality for Hot Reloading and bootstrapping the theme.

### Asset Compilation
Asset compilation for this theme is controlled by Vite and can be done by running `npm run dev` or `npm run build` in the theme directory.

As a shortcut, from the host machine you can either run `ddev theme-dev` or `ddev theme-build` to run the respective NPM commands.

## Blocks Plugin
In WordPress the standard process for creating blocks can be a little difficult to do from scratch. In order to assist in the creation of blocks in this project, we have included a custom blocks plugin that will allow you to create blocks and child blocks with ease. The plugin is located in the `mu-plugins/wordpress-blocks` directory. If you check the README for that plugin you will see instructions on how to create a new block.
