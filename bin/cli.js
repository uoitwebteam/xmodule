#!/usr/bin/env node

const fs = require('fs');
const path = require('path');

const TEMPLATES_PATH = path.join(__dirname, 'templates');
const SRC_PATH = path.join(__dirname, '../src');
const XMODULE_PATH = path.join(SRC_PATH, 'XModule');
const XMODULE_FORMS_PATH = path.join(XMODULE_PATH, 'Forms');
const CONSTANTS_PATH = path.join(XMODULE_PATH, 'Constants');
const TRAITS_PATH = path.join(XMODULE_PATH, 'Traits');

const TYPE_ELEMENT = 'element';
const TYPE_FORMCONTROL = 'formcontrol';
const TYPE_ENUM = 'enum';
const TYPE_TRAIT = 'trait';

const {
  argv
} = require('yargs') // eslint-disable-line
  .usage('Usage: $0 [options]')
  .command('$0 <type> <name>', 'Scaffold a new component', yargs => {
    yargs
      .positional('type', {
        describe: 'Type of component to scaffold (element, formcontrol, enum, trait)',
        default: TYPE_ELEMENT
      })
      .positional('name', {
        describe: 'Name of component to scaffold (myComponent)',
      })
      .example('$0 element toolbar', '(Scaffold a new element called Toolbar)')
  });

const renderTemplate = (type, ctx = {}) => {
  return require('lodash.template')(fs.readFileSync(path.join(TEMPLATES_PATH, `${type}.php`)))(ctx);
}

const uppercaseFirst = string => `${string.charAt(0).toUpperCase()}${string.substr(1)}`;
const writeFile = (filepath, content) => new Promise((resolve, reject) => {
  fs.writeFile(filepath, content, err => {
    if (err) {
      reject(err);
    }
    resolve(filepath);
  });
});

const createXModule = (id, type = TYPE_ELEMENT, path = XMODULE_PATH) => {
  const classname = uppercaseFirst(id);
  const constant = id.replace(/([A-Z])/g, word => `_${word}`).toUpperCase();
  renderAndWrite(classname, type, path, {
    constant
  }, false);
}

const createEnum = id => {
  const classname = uppercaseFirst(id);
  renderAndWrite(classname, TYPE_ENUM, CONSTANTS_PATH, {}, false);
}

const createTrait = name => {
  const classname = uppercaseFirst(name);
  renderAndWrite(`With${classname}`, TYPE_TRAIT, TRAITS_PATH, {
    name,
    classname
  }, false);
}

const renderAndWrite = (classname, type, folder, ctx = {}, overwrite = true) => {
  const rendered = renderTemplate(type, {
    ...ctx,
    classname: ctx.classname || classname
  });
  const filepath = path.join(folder, `${classname}.php`);
  if (!overwrite && fs.existsSync(filepath)) {
    throw new Error(`file already exists at path: ${filepath}`);
  }
  return writeFile(filepath, rendered)
    .then(filepath => console.log(`${uppercaseFirst(type)} created at ${filepath}`))
    .catch(error => console.error(error));
}

switch (argv.type) {
  case TYPE_ELEMENT:
    createXModule(argv.name);
    break;
  case TYPE_FORMCONTROL:
    createXModule(argv.name, argv.type, XMODULE_FORMS_PATH);
    break;
  case TYPE_TRAIT:
    createTrait(argv.name);
    break;
  case TYPE_ENUM:
    createEnum(argv.name);
    break;
}