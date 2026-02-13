# Rebuild stylesheet
node ./node_modules/sass/sass.js ./style/custom_bootstrap.scss ./style/custom_bootstrap.css

# Rebuild table of contents in README.md
node ./node_modules/doctoc/doctoc.js ./README.md
