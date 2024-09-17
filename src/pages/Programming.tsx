import { useEffect, useState } from "react";

import type { Entry, FieldsType } from "contentful";
import { contentfulClient } from "../lib/contentful";
import { format, isAfter, sub } from "date-fns";

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

  const upcomingPrograms = entries.filter(({ fields }) =>
    isAfter(fields.date, sub(new Date(), { days: 1 }))
  );

  const upcomingProgramsByMonth = upcomingPrograms.reduce<{
    [key: string]: any[];
  }>((acc, program) => {
    const month = format(new Date(program.fields.date), "y-M-01");
    acc[month] ??= [];
    acc[month].push(program.fields);
    return acc;
  }, {});

  const upcomingProgramsByMonthDisplay = Object.keys(upcomingProgramsByMonth)
    .sort((a, b) => (isAfter(a, b) ? 1 : -1))
    .map((month) => ({
      month: format(month, "MMMM"),
      programs: upcomingProgramsByMonth[month].sort((a, b) =>
        isAfter(a.date, b.date) ? 1 : -1
      ),
    }));

  return (
    <div>
      <Header />
      <CTA field={fields?.cta} />
      <Section classNames={[]}>
        <h3 className="page-title">Upcoming Programming</h3>
        {upcomingProgramsByMonthDisplay.map(({ month, programs }) => (
          <>
            <div className="month">
              <h2 className="typography__charlie color--white">{month}</h2>
            </div>
            <div className="programs-wrapper">
              {programs.map((program) => (
                <Program
                  agency={program.agency}
                  visibleDate={program.visibleDate}
                  representative={program.representative}
                  description={program.description}
                  contact={program.contact}
                />
              ))}
            </div>
          </>
        ))}
      </Section>
      <Footer fieldLeft={fields?.footerLeft} fieldRight={fields?.footerRight} />
    </div>
  );
};
