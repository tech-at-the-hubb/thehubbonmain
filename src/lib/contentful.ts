const contentful = require("contentful");

export const contentfulClient = contentful.createClient({
  accessToken: process.env.REACT_APP_CONTENTFUL_DELIVERY_TOKEN,
  space: process.env.REACT_APP_CONTENTFUL_SPACE_ID,
});
