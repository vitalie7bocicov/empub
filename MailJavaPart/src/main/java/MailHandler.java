import org.apache.commons.io.IOUtils;
import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.nodes.Node;
import org.jsoup.select.Elements;

import javax.mail.BodyPart;
import javax.mail.MessagingException;
import javax.mail.internet.MimeBodyPart;
import javax.mail.internet.MimeMultipart;
import javax.mail.internet.MimeUtility;
import java.io.*;
import java.time.LocalDateTime;
import java.util.*;

public class MailHandler {
    private boolean exist = false;
    private List<Attachment> attachments = new ArrayList<>();
    private Mail currentMail = new Mail();
    private MailContent mailContent = new MailContent();
    private Tags tags;

    public Tags getTags() {
        return tags;
    }

    public void setTags(Tags tags) {
        this.tags = tags;
    }

    public MailContent getMailContent() {
        return mailContent;
    }

    public List<Attachment> getAttachments() {
        return attachments;
    }

    public Mail getCurrentMail() {
        return currentMail;
    }

    public void setCurrentMail(Mail currentMail) {
        this.currentMail = currentMail;
    }


    public MailHandler() {

    }

    public void MessageLookUp(MimeMultipart msg) throws MessagingException, IOException {
        int partsCount = msg.getCount();
        String mainContentType = msg.getContentType();

        for(int i = 0; i < partsCount; i++) {
            MimeBodyPart child = (MimeBodyPart) msg.getBodyPart(i);
            String contentType = child.getContentType();
            System.out.println(contentType);
            if(contentType.indexOf("multipart") == 0) {
                MimeMultipart mulitChild = (MimeMultipart) child.getContent();
                MessageLookUp(mulitChild);
            }
            else if(contentType.indexOf("TEXT/PLAIN") == 0) {
                getSubjectAndSender(child);
            }
            else if(contentType.indexOf("TEXT/HTML") == 0) {
                getHtml((String) child.getContent());
            }
            else {
                int relationship = mainContentType.indexOf("RELATED");
                int attachmets = mainContentType.indexOf("MIXED");

                if(relationship != -1) {
                    extractFile(child, "related");
                }

                if(attachmets != -1) {
                    extractFile(child, "attachment");
                }

            }
        }
    }

    public void seeChildElements(Node elem) {
        List<Node> children = elem.childNodes();

        for(Node child : children) {
            List<Node> list = child.childNodes();

            if(list.size() == 0) {
                String content = child.toString();
                if(content.indexOf(tags.getSubject()) != -1) {
                    this.exist = true;
                }
            }
            else {
                seeChildElements(child);
            }
        }
    }

    public void getHtml(String message) {
        Document doc = Jsoup.parse(message, "UTF-8");

        Elements tables = doc.getElementsByTag("table");
        Elements paragraphs = doc.getElementsByTag("p");

        Element tableParent = null;
        Element tableChild = null;
        Element paragraphParent = null;
        Element paragraphChild = null;


        if(tables.size() != 0) {
            tableParent = tables.first().parent();
            tableChild = tables.first();

            while(!exist && tableParent != null) {
                seeChildElements(tableParent);

                if(!exist) {
                    tableChild = tableChild.parent();
                }

                tableParent = tableParent.parent();
            }
        }
        else if(paragraphs.size() != 0) {
            paragraphParent = paragraphs.first().parent();
            paragraphChild = paragraphs.first();
            while(!exist && paragraphParent != null) {
                seeChildElements(paragraphParent);
                if(!exist) {
                    paragraphChild = paragraphChild.parent();
                }

                paragraphParent = paragraphParent.parent();
            }
        }

        String skelet = "<html><head><meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\"/></head><body></body></html>";
        Document docFinal = Jsoup.parse(skelet);
        Element body = docFinal.body();
        if(tableChild != null) {
            body.appendChild(tableChild);
        }

        if(paragraphChild != null) {
            body.appendChild(paragraphChild);
        }

        mailContent.setHtml(docFinal.toString());
    }

    public List<String> findKeywordPair(String message, String keyword) {
        List<String> keywords = List.of(tags.getFrom(), tags.getSubject(), tags.getTo(), tags.getDate(), tags.getDuration(), tags.getPassword());
        int subjectIndex = message.indexOf(keyword);

        List<String> words = new ArrayList<>();
        if(subjectIndex != -1) {
            String messageSubjectMessage = message.substring(subjectIndex + keyword.length());

            messageSubjectMessage = messageSubjectMessage.trim();
            String[] wordsList = messageSubjectMessage.split("\r\n");

            if(wordsList.length == 1)
                wordsList = messageSubjectMessage.split("\n");

            int index = 0;
            boolean found = false;

            String firstRow = wordsList[0];
            String[] firstRowInWords = firstRow.split(" ");

            while(!found && index < firstRowInWords.length) {
                boolean isKeyWord = keywords.contains(firstRowInWords[index]);

                if(isKeyWord) {
                    found = true;
                }
                else {
                    words.add(firstRowInWords[index]);
                }

                index += 1;
            }
        }

        return words;
    }

    public void addExpirationTime(String timeConst, int number) {
        List<String> timeKeyWords = List.of("y", "mon", "d", "h", "m");

        int index = timeKeyWords.indexOf(timeConst);

        if(index == 0) {
            LocalDateTime expiartionDate = currentMail.getExpirationDate();
            expiartionDate = expiartionDate.plusYears(number);
            currentMail.setExpirationDate(expiartionDate);
        }
        else if(index == 1) {
            LocalDateTime expiartionDate = currentMail.getExpirationDate();
            expiartionDate = expiartionDate.plusMonths(number);
            currentMail.setExpirationDate(expiartionDate);
        }
        else if(index == 2) {
            LocalDateTime expiartionDate = currentMail.getExpirationDate();
            expiartionDate = expiartionDate.plusDays(number);
            currentMail.setExpirationDate(expiartionDate);
        }
        else if(index == 3) {
            LocalDateTime expiartionDate = currentMail.getExpirationDate();
            expiartionDate = expiartionDate.plusHours(number);
            currentMail.setExpirationDate(expiartionDate);
        }
        else {
            LocalDateTime expiartionDate = currentMail.getExpirationDate();
            expiartionDate = expiartionDate.plusMinutes(number);
            currentMail.setExpirationDate(expiartionDate);
        }
    }

    public void parseDuration(String durationString) {
        List<String> timeKeyWords = List.of("y", "mon", "d", "h", "m");

        durationString = durationString.trim();
        String number = "";
        String timeConst = "";
        for(int i = 0; i < durationString.length(); i++) {
            char character = durationString.charAt(i);


            if(Character.isDigit(character) && !number.equals("") && !timeConst.equals("")) {
                if(!timeKeyWords.contains(timeConst)) {
                    //Invalid data format
                }

                addExpirationTime(timeConst, Integer.parseInt(number));
                number = "";
                timeConst = "";
                number += String.valueOf(character);
            }
            else if(Character.isDigit(character)) {
                number += String.valueOf(character);
            }
            else if(Character.isLetter(character)) {
                timeConst += String.valueOf(character);
            }

        }

        if(!timeKeyWords.contains(timeConst)) {
            //Invalid data format
        }

        addExpirationTime(timeConst, Integer.parseInt(number));
    }


    public void getSubjectAndSender(BodyPart message) throws MessagingException, IOException {
        List<String> keywords = List.of(tags.getFrom(), tags.getSubject(), tags.getTo(), tags.getDate(), tags.getDuration(), tags.getPassword());
        InputStream stream = message.getInputStream();

        String msg = IOUtils.toString(stream, "utf-8");

        String emailSubject = "";
        String emailSender = "";
        String emailAdress = "";
        List<String> subject = findKeywordPair(msg, tags.getSubject());
        List<String> from = findKeywordPair(msg, tags.getFrom());
        List<String> password = findKeywordPair(msg, tags.getPassword());
        List<String> duration = findKeywordPair(msg, tags.getDuration());

        if(subject.size() > 0) {
            emailSubject = String.join(" ", subject);

            currentMail.setSubject(emailSubject);
        }

        if(from.size() > 0) {
            emailAdress = from.get(from.size() - 1);
            from.remove(from.size() - 1);
            emailAdress = emailAdress.substring(1, emailAdress.length() - 1);
            emailSender = String.join( " ", from);

            currentMail.setSender(emailSender);
            currentMail.setSenderEmail(emailAdress);
        }

        if(password.size() > 0) {
            String newPassword = String.join( " ", password);

            if(password.size() > 1) {}

            currentMail.setPublicParam(false);
            currentMail.setPassword(newPassword);
        }
        else {
            currentMail.setPublicParam(true);
            currentMail.setPassword(null);
        }

        if(duration.size() > 0) {
            String durationString = String.join("", duration);
            parseDuration(durationString);
        }
        else {
            addExpirationTime("mon", 1);
        }


        int index = 0;
        int maxIndex = 0;
        for(String keyword : keywords) {
            index = msg.indexOf(keyword);

            if(index > maxIndex) {
                maxIndex = index;
            }
        }

        String newMessage = "";
        if(maxIndex != 0) {
            newMessage = msg.substring(maxIndex);
        }


        List<String> splitString = List.of(newMessage.split("\r\n"));
        if(splitString.size() == 1)
            splitString = List.of(newMessage.split("\n"));

        newMessage = "";
        for(int i = 1; i < splitString.size(); i++) {
            newMessage += splitString.get(i);
            newMessage += "\r\n";
        }

        newMessage = newMessage.trim();
        mailContent.setPlainText(newMessage);
    }


    public void extractFile(BodyPart part, String relationship) throws MessagingException, IOException {
        String[] contentType = part.getHeader("Content-Type");
        String[] contentId = part.getHeader("Content-ID");
        String fileName = "";
        String fileID = "";
        Attachment attachment = new Attachment();

        for(String s : contentType) {
            int indexName = s.indexOf("name=");
            fileName = s.substring(indexName + 5);

            if(fileName.charAt(0) == '"') {
                fileName = fileName.substring(1, fileName.length() - 1);

            }

            fileName = MimeUtility.decodeText(fileName);
        }

        System.out.println(fileName);
        if (contentId != null) {
            fileID = contentId[0];
            fileID = fileID.substring(1, fileID.length() - 1);
            fileID = MimeUtility.decodeText(fileID);
        }


        String filePath = "E:\\ProgramFiles\\xampp\\htdocs\\TehnologiiWeb\\storage";
        filePath += "\\" + currentMail.getMailNumber();

        if(!new File(filePath).exists()) {
            new File(filePath).mkdir();
        }

        boolean hasUniqueName = false;
        int index = 0;
        String copie = fileName;
        while(!hasUniqueName) {
            if(!new File(filePath + "\\" + fileName).exists()) {
                filePath += "\\" + fileName;
                new File(filePath).createNewFile();
                hasUniqueName = true;
            }
            else {
                index += 1;
                fileName = copie;
                fileName += Integer.toString(index);
            }
        }

        attachment.setName(fileName);
        attachment.setContentID(fileID);
        attachment.setRelation(relationship);
        attachments.add(attachment);
        File file = new File(filePath);
        InputStream stream = part.getInputStream();
        byte[] content = IOUtils.toByteArray(stream);

        FileOutputStream fileOutput = new FileOutputStream(file);
        BufferedOutputStream buffer = new BufferedOutputStream(fileOutput);

        buffer.write(content);
        buffer.close();
    }

}