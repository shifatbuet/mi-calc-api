import React, { useState } from "react";
import axios from "axios";
import { Row, Col, Form, Button } from "react-bootstrap";

const URL = "http://localhost:8090/api/calculate";

function App() {
  const [input_1, setFirstInput] = useState(null);
  const [input_2, setSecondInput] = useState(null);
  const [operation, setOperator] = useState("add");

  const handleSubmit = (e) => {
    e.preventDefault();
    if (!input_1 || !input_2 || !operation) {
      alert("Please add all value");
      window.location.reload();
      return;
    }
    const postData = {
      input_1: parseInt(input_1),
      input_2: parseInt(input_2),
      operation,
    };

    axios
      .post(URL, postData)
      .then((response) => alert(`Your result is ${response?.data?.data}`))
      .catch((error) => {
        alert("There was an error!", error.message);
      });
  };

  return (
    <div className="container">
      <h2 className="mb-3 mt-5 text-center">Emoji calculator</h2>

      <Form onSubmit={handleSubmit}>
        <Row className="align-items-center">
          <Col sm={3} className="my-1">
            <Form.Label htmlFor="first_input" visuallyHidden>
              First Input
            </Form.Label>
            <Form.Control
              type="number"
              name="input_1"
              value={input_1}
              onChange={(e) => setFirstInput(e.target.value)}
              id="first_input"
              placeholder="First input"
              autoComplete="false"
            />
          </Col>

          <Col sm={3} className="my-1">
            <Form.Label
              className="me-sm-2"
              htmlFor="inlineFormCustomSelect"
              visuallyHidden
            >
              Preference
            </Form.Label>
            <Form.Select
              className="me-sm-2"
              name="operator"
              value={operation}
              onChange={(e) => setOperator(e.target.value)}
              id="inlineFormCustomSelect"
            >
              <option value="">Choose Emoji 😃 </option>
              <option value="add">👽 Addition</option>
              <option value="subtract">💀 Subtraction</option>
              <option value="multiply">👻 Multiplication</option>
              <option value="divide">😱 Division</option>
            </Form.Select>
          </Col>

          <Col sm={3} className="my-1">
            <Form.Label htmlFor="second_input" visuallyHidden>
              Second Input
            </Form.Label>
            <Form.Control
              type="number"
              name="input_2"
              value={input_2}
              onChange={(e) => setSecondInput(e.target.value)}
              id="first_input"
              placeholder="Second input"
              autoComplete="false"
            />
          </Col>

          <Col xs="auto" className="my-1">
            <Button type="submit">Submit</Button>
          </Col>
        </Row>
      </Form>
    </div>
  );
}

export default App;
