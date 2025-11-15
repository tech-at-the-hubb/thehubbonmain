import { useEffect, useState } from "react";

import type { Entry, FieldsType } from "contentful";
import { contentfulClient } from "../lib/contentful";

import { CTA } from "../components/CTA";
import { Footer } from "../components/Footer";
import { Header } from "../components/Header";
import { Section } from "../components/Section";
import { Program } from "../components/Program";
import "./Programming.css";

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

  const [entries, setEntries] = useState<FieldsType[]>([]);

  const getEntries = async () => {
    await contentfulClient
      .getEntries({
        content_type: "program",
      })
      .then((result: FieldsType) => {
        setEntries(result.items);
      })
      .catch((err: Error) => console.log(err));
  };

  useEffect(() => {
    getEntries();
    getHomeContent();
  }, []);

  return (
    <div>
      <Header />
      <CTA field={fields?.cta} />
      <Section classNames={[]}>
        <h3 className="page-title">Programming</h3>
        <div className="programs-wrapper">
          {entries.map(({ fields }) => (
            <Program
              agency={fields.agency}
              visibleDate={fields.visibleDate}
              representative={fields.representative}
              description={fields.description}
              contact={fields.contact}
            />
          ))}
        </div>
      </Section>
      <Footer fieldLeft={fields?.footerLeft} fieldRight={fields?.footerRight} />
    </div>
  );
};
