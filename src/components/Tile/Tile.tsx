import "./Tile.css";

type TileProps = {
  backgroundColor: string;
  textColor: string;
  text: string;
  isWide?: boolean;
};

export const Tile = ({
  backgroundColor,
  textColor,
  text,
  isWide,
}: TileProps) => {
  return (
    <div
      className={["tile", backgroundColor, !!isWide ? "span2" : ""].join(" ")}
    >
      <p className={["typography__charlie", textColor].join(" ")}>{text}</p>
    </div>
  );
};
