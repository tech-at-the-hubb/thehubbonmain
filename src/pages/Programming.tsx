import { Entry, type FieldsType } from "contentful";

import { useEffect, useState } from "react";

import { contentfulClient } from "../lib/contentful";

import { CTA } from "../components/CTA";
import { Footer } from "../components/Footer";
import { Header } from "../components/Header";
import { Section } from "../components/Section";

export const Programming = () => {
  const [fields, setFields] = useState<FieldsType>();

  const getHomeContent = async () => {
    await contentfulClient
      .getEntry("3V7dAsgvkJyOT6WoySbt4f")
      .then((entry: Entry) => {
        setFields(entry.fields);
        console.log(entry);
      })
      .catch((err: Error) => console.log(err));
  };

  useEffect(() => {
    getHomeContent();
  }, []);

  return (
    <div>
      <Header />
      <CTA field={fields?.cta} />
      <Section classNames={[]}>programming</Section>
      <Footer fieldLeft={fields?.footerLeft} fieldRight={fields?.footerRight} />
    </div>
  );
};
