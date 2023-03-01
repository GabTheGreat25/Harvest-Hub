import * as React from "react";
import ListItemButton from "@mui/material/ListItemButton";
import ListItemIcon from "@mui/material/ListItemIcon";
import ListItemText from "@mui/material/ListItemText";
import DashboardIcon from "@mui/icons-material/Dashboard";
import { useNavigate } from "react-router-dom";

function ListItem(props) {
  const { title, link } = props;

  const navigate = useNavigate();

  return (
    <>
      <ListItemButton>
        <ListItemIcon>
          <DashboardIcon />
        </ListItemIcon>
        <ListItemText
          primary={title}
          onClick={() => {
            navigate(link);
          }}
        />
      </ListItemButton>
    </>
  );
}

export default ListItem;
