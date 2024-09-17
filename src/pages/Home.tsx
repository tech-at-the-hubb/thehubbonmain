import { Entry, type FieldsType } from "contentful";

import { useEffect, useState } from "react";

import { documentToReactComponents } from "@contentful/rich-text-react-renderer";
import { contentfulClient } from "../lib/contentful";

import { Header } from "../components/Header";
import { CTA } from "../components/CTA";
import { Section } from "../components/Section";
import { Tile } from "../components/Tile";
import { Footer } from "../components/Footer";
import "./Home.css";

export const Home = () => {
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
    <div className="App">
      <Header />
      <CTA field={fields?.cta} />
      {/* hero ------------------------------------------------------------- */}
      <Section classNames={["hero"]}>
        <div className="hero-inner">
          <div className="typography__hero">
            {documentToReactComponents(fields?.heroHeader)}
          </div>
          <div className="grid grid__two-thirds quote typography__alpha typography--light color--blue6">
            {documentToReactComponents(fields?.heroQuote)}
          </div>
        </div>
      </Section>
      {/* funding note ----------------------------------------------------- */}
      <Section classNames={[]}>
        <div className="typography__alpha color--neutral8">
          {documentToReactComponents(fields?.fundingNote)}
        </div>
      </Section>

      {/* tiles -------------------------------------------------------------*/}
      <Section classNames={["tiles"]}>
        <div className="tile-wrapper">
          <Tile
            isWide
            backgroundColor="bgcolor--blue8"
            textColor="color--white"
            text="The Hubb includes programming for"
          />
          <Tile
            backgroundColor="bgcolor--neutral4"
            textColor="color--orange10"
            text="Students"
          />
          <Tile
            isWide
            backgroundColor="bgcolor--neutral2"
            textColor="color--blue6"
            text="Entrepreneurs"
          />
          <Tile
            backgroundColor="bgcolor--orange2"
            textColor="color--blue8"
            text="Families"
          />
          <Tile
            backgroundColor="bgcolor--neutral4"
            textColor="color--blue6"
            text="Senior Citizens"
          />
          <Tile
            isWide
            backgroundColor="bgcolor--orange2"
            textColor="color--orange10"
            text="Small Business Owners"
          />
          <Tile
            isWide
            backgroundColor="bgcolor--neutral4"
            textColor="color--orange10"
            text="Individuals in Recovery"
          />
          <Tile
            backgroundColor="bgcolor--neutral2"
            textColor="color--neutral8"
            text="& more"
          />
        </div>
      </Section>

      {/* non profit note ---------------------------------------------------*/}
      <Section classNames={[]}>
        <div className="typography__delta color--neutral8">
          {documentToReactComponents(fields?.nonProfitNote)}
        </div>
      </Section>

      <Footer fieldLeft={fields?.footerLeft} fieldRight={fields?.footerRight} />
    </div>
  );
};
